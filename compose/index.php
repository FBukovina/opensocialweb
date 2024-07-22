<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
<meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#0000">
    <link href="/src/styles/styles.css" rel="stylesheet">
    <link href="/src/styles/timeline.css" rel="stylesheet">
    <link href="/src/styles/menus.css" rel="stylesheet">
    <link href="/src/styles/responsive.css" rel="stylesheet">
  
    <script defer src="https://cdn.jsdelivr.net/npm/@twemoji/api@latest/dist/twemoji.min.js"
        crossorigin="anonymous"></script>
    <script src="/src/scripts/general.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>new theet - the opensocial</title>
</head>

<body>
    <header>
        <div id="desktopMenu">
            <nav>
                <img src="/src/images/icons/chirp.svg" alt="the opensocial" onclick="playChirpSound()">
                <a href="/"><img src="/src/images/icons/house.svg" alt=""> Home</a>
                <a href="explore"><img src="/src/images/icons/search.svg" alt=""> Discover</a>
                <a href="notifications"><img src="/src/images/icons/bell.svg" alt=""> Notifications</a>
                <a href="messages"><img src="/src/images/icons/envelope.svg" alt=""> Direct Messages</a>
                <a
                href="<?php echo isset($_SESSION['username']) ? '/user?id=' . htmlspecialchars($_SESSION['username']) : '/signin'; ?>"><img
                    src="/src/images/icons/person.svg" alt=""> Profile</a>
            </nav>
            <div id="menuSettings">
                <a href="settings">⚙️ Settings</a>
                <?php if (isset($_SESSION['username'])): ?>
                <a href="/signout.php">🚪 sign out</a>
                <?php else: ?>
                <a href="/signin/">🚪 sign in</a>
                <?php endif; ?>
            </div>
            <button id="settingsButtonWrapper" type="button" onclick="showMenuSettings()">
                <img class="userPic"
                    src="<?php echo isset($_SESSION['profile_pic']) ? htmlspecialchars($_SESSION['profile_pic']) : '/src/images/users/guest/user.svg'; ?>"
                    alt="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'guest'; ?>">
                <div>
                    <p class="usernameMenu"><?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Guest'; ?>
                        <?php if (isset($_SESSION['is_verified']) && $_SESSION['is_verified']): ?>
                            <img class="emoji" src="/src/images/icons/verified.svg" alt="Verified">
                        <?php endif; ?>
                    </p>
                    <p class="subText">
                        @<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'guest'; ?>
                    </p>
                </div>
                <p class="settingsButton">⚙️</p>
            </button>
        </div>
    </header>
    <main>
        <div id="cancelModal" class="modal">
            <div class="modal-content">
                <h2>save it for future?</h2>
                <p>it seems like you've written something without posting it.<br>do u want to hold on to what
                    you wrote and save it as a draft on your device?</p>
                <button id="saveDraftButton" class="modal-button">save the post</button>
                <button id="discardDraftButton" class="modal-button">throw out the post</button>
            </div>
        </div>
        <div id="feedCompose">
            <div id="iconChirp">
                <img src="/src/images/icons/write.svg" alt="Write">
            </div>
            <div class="title">
                <p class="selected">new post</p>
            </div>
            <form method="POST" action="/compose/submit.php">
                <div id="composer">
                    <textarea name="chirpComposeText" maxlength="240" placeholder="what's happening?"></textarea>
                </div>
                <div id="exploreChirp" class="searchButtons">
                    <button type="button" class="cancelTheet" onclick="slideDown()">discard</button>
                    <button type="submit" class="postTheet" onclick="slideDownPost()">post</button>
                </div>
            </form>
            <div class="title">
                <p class="selected">drafts</p>
            </div>
            <div class="drafts-container">
                <p class="subText">u don't have any posts in drafts.</p>
            </div>
        </div>
    </main>
    <aside id="sideBar">
    <?php include '../include/sideBar.php';?>
    </aside>
    <footer>
        <div>
            <a href="/"><img src="/src/images/icons/house.svg" alt="Home"></a>
            <a href="/discover"><img src="/src/images/icons/search.svg" alt="Discover"></a>
            <a href="/notifications"><img src="/src/images/icons/bell.svg" alt="Notifications"></a>
            <a href="/messages"><img src="/src/images/icons/envelope.svg" alt="Direct Messages"></a>
            <a
                href="<?php echo isset($_SESSION['username']) ? '/user?id=' . htmlspecialchars($_SESSION['username']) : '/signin'; ?>"><img
                    src="/src/images/icons/person.svg" alt="Profile"></a>
        </div>
    </footer>
    <script>
        <?php
        if (isset($_SESSION['error_message'])) {
            echo 'console.error(' . json_encode($_SESSION['error_message']) . ');';
            unset($_SESSION['error_message']); // Clear the error message after displaying it
        }
        ?>
    </script>
</body>

</html>