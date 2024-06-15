<?php
try {
    $db = new PDO('sqlite:' . __DIR__ . '/chirp.db');
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#00001" />
    <link href="/src/styles/styles.css" rel="stylesheet">
    <link href="/src/styles/timeline.css" rel="stylesheet">
    <link href="/src/styles/menus.css" rel="stylesheet">
    <link href="/src/styles/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/@twemoji/api@latest/dist/twemoji.min.js" crossorigin="anonymous"></script>
    <script src="/src/scripts/general.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Home / Chirp</title>
</head>
<body>
    <header>
        <div id="desktopMenu">
            <nav>
                <img src="/src/images/icons/chirp.svg" alt="Chirp" onclick="playChirpSound()">
                <a href="/"><img src="/src/images/icons/house.svg" alt=""> Home</a>
                <a href="/explore"><img src="/src/images/icons/search.svg" alt=""> Explore</a>
                <a href="/notifications"><img src="/src/images/icons/bell.svg" alt=""> Notifications</a>
                <a href="/messages"><img src="/src/images/icons/envelope.svg" alt=""> Messages</a>
                <a href="/profile"><img src="/src/images/icons/person.svg" alt=""> Profile</a>
                <a href="/compose" class="newchirp">Chirp</a>
            </nav>
            <div id="menuSettings">
                <a href="settings">⚙️ Settings</a>
                <a href="signin">🚪 Sign in</a>
            </div>
            <button id="settingsButtonWrapper" type="button" onclick=showMenuSettings()>
                <img class="profilePic" src="/src/images/profiles/guest/profile.svg" alt="Guest">
                <div>
                    <p>Guest</p>
                    <p class="subText">@guest</p>
                </div>
                <p class="settingsButton">⚙️</p>
            </button>
        </div>
        </header>
    <main>
        <div id="feed">
            <div id="iconChirp" onclick="playChirpSound()">
                <img src="/src/images/icons/chirp.svg" alt="Chirp">
            </div>
            <div id="timelineSelect">
                <a id="forYou" class="selected" href="/">For you</a>
                <a id="following" href="following">Following</a>
            </div>
            <div id="highTraffic">
                <p>We're experiencing very high traffic right now.<br>Chirpie is trying his best, but if Chirp slows down, don't panic!</p>
            </div>
            <div id="chirps" data-offset="0">
                <!-- Chirps will be loaded here -->
            </div>
            <div id="noMoreChirps" style="display: none;">
                <div class="lds-ring">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </main>

    <aside id="sideBar">
        <div id="trends">
            <p>Trends for you</p>
            <div>
                <a>gay people</a>
                <p class="subText">12 chirps</p>
            </div>
            <div>
                <a>twitter</a>
                <p class="subText">47 chirps</p>
            </div>
            <div>
                <a>iphone 69</a>
                <p class="subText">62 chirps</p>
            </div>
        </div>
        <div id="whotfollow">
            <p>Who to follow</p>
            <div>
                <div>
                    <img class="profilePic" src="https://pbs.twimg.com/profile_images/1717013664954499072/2dcJ0Unw_400x400.png" alt="Apple">
                    <div>
                        <p>Apple <img class="verified" src="/src/images/icons/verified.svg" alt="Verified"></p>
                        <p class="subText">@apple</p>
                    </div>
                </div>
                <a class="followButton">Follow</a>
            </div>
            <div>
                <div>
                    <img class="profilePic" src="https://pbs.twimg.com/profile_images/1380530524779859970/TfwVAbyX_400x400.jpg" alt="President Biden">
                    <div>
                        <p>President Biden <img class="verified" src="/src/images/icons/verified.svg" alt="Verified"></p>
                        <p class="subText">@POTUS</p>
                    </div>
                </div>
                <a class="followButton">Follow</a>
            </div>
        </div>
        <div>
            <p class="subText">Inspired by Twitter/X. No code has been sourced from Twitter/X. Twemoji by Twitter Inc/X Corp is licensed under CC-BY 4.0.</p>
        </div>
    </aside>
    <footer>
    <div class="mobileCompose">
        <a class="chirpMoile" href="compose">Chirp</a>
    </div>
        <div>
            <a href="/" class="active"><img src="/src/images/icons/house.svg" alt="Home"></a>
            <a href="/explore"><img src="/src/images/icons/search.svg" alt="Explore"></a>
            <a href="/notifications"><img src="/src/images/icons/bell.svg" alt="Notifications"></a>
            <a href="/messages"><img src="/src/images/icons/envelope.svg" alt="Messages"></a>
            <a href="/profile"><img src="/src/images/icons/person.svg" alt="Profile"></a>
        </div>
    </footer>
    <script>
    let loadingChirps = false; // Flag to track if chirps are currently being loaded

    function updatePostedDates() {
        const chirps = document.querySelectorAll('.chirp .postedDate');
        chirps.forEach(function (chirp) {
            const timestamp = chirp.getAttribute('data-timestamp');
            const postDate = new Date(parseInt(timestamp) * 1000);
            const now = new Date();
            const diffInMilliseconds = now - postDate;
            const diffInSeconds = Math.floor(diffInMilliseconds / 1000);
            const diffInMinutes = Math.floor(diffInSeconds / 60);
            const diffInHours = Math.floor(diffInMinutes / 60);
            const diffInDays = Math.floor(diffInHours / 24);

            let relativeTime;

            if (diffInSeconds < 60) {
                relativeTime = diffInSeconds + "s ago";
            } else if (diffInMinutes < 60) {
                relativeTime = diffInMinutes + "m ago";
            } else if (diffInHours < 24) {
                relativeTime = diffInHours + "h ago";
            } else if (diffInDays < 7) {
                relativeTime = diffInDays + "d ago";
            } else {
                const options = {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                };
                relativeTime = postDate.toLocaleString([], options);
            }

            chirp.textContent = relativeTime;
        });
    }

    function showLoadingSpinner() {
        document.getElementById('noMoreChirps').style.display = 'block';
    }

    function hideLoadingSpinner() {
        document.getElementById('noMoreChirps').style.display = 'none';
    }

    function loadChirps() {
        if (loadingChirps) return; // If already loading, exit

        const chirpsContainer = document.getElementById('chirps');
        const offset = parseInt(chirpsContainer.getAttribute('data-offset'));

        loadingChirps = true; // Set loading flag
        showLoadingSpinner(); // Show loading spinner

        setTimeout(() => {
            fetch(`/fetch_chirps.php?offset=${offset}`)
                .then(response => response.json())
                .then(chirps => {
                    chirps.forEach(chirp => {
                        const chirpDiv = document.createElement('div');
                        chirpDiv.className = 'chirp';
                        chirpDiv.id = chirp.id;
                        chirpDiv.innerHTML = `
                            <a class="chirpClicker" href="/chirp/?id=${chirp.id}">
                                <div class="chirpInfo">
                                    <div>
                                        <img class="profilePic" src="/src/images/profiles/guest/profile.svg" alt="Guest">
                                        <div>
                                            <p>${chirp.user}</p>
                                            <p class="subText">@guest</p>
                                        </div>
                                    </div>
                                    <div class="timestampTimeline">
                                        <p class="subText postedDate" data-timestamp="${chirp.timestamp}"></p>
                                    </div>
                                </div>
                                <pre>${chirp.chirp}</pre>
                                <div class="chirpInteract">
                                    <button type="button" class="reply"><img alt="Reply" src="/src/images/icons/reply.svg"> 0</button>
                                    <button type="button" class="rechirp"><img alt="Rechirp" src="/src/images/icons/rechirp.svg"> 0</button>
                                    <button type="button" class="like"><img alt="Like" src="/src/images/icons/like.svg"> 0</button>
                                </div>
                            </a>
                        `;
                        chirpsContainer.appendChild(chirpDiv);
                    });

                    chirpsContainer.setAttribute('data-offset', offset + 6);

                    updatePostedDates();

                    twemoji.parse(chirpsContainer);
                })
                .catch(error => {
                    console.error('Error fetching chirps:', error);
                })
                .finally(() => {
                    loadingChirps = false; // Reset loading flag
                    hideLoadingSpinner(); // Hide loading spinner
                });
        }, 1000);
    }

    loadChirps();

    window.addEventListener('scroll', () => {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
            loadChirps();
        }
    });

    setInterval(updatePostedDates, 1000);
</script>
</body>
</html>