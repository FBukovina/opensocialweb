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
    <title>discover - the opensocial</title>
</head>

<body>
    <header>
        <div id="desktopMenu">
            <nav>
         <img src="/src/images/icons/chirp.svg" alt="the opensocial">
                <a href="/"><img src="/src/images/icons/house.svg" alt=""> Home</a>
                <a href="/discover" class="activeDesktop"><img src="/src/images/icons/search.svg" alt=""> Discover</a>
                <a href="/notifications"><img src="/src/images/icons/bell.svg" alt=""> Notifications</a>
                <a href="/messages"><img src="/src/images/icons/envelope.svg" alt=""> Direct Messages</a>
                <a
                href="<?php echo isset($_SESSION['username']) ? '/user?id=' . htmlspecialchars($_SESSION['username']) : '/signin'; ?>"><img
                    src="/src/images/icons/person.svg" alt=""> Profile</a>
                <a href="/compose" class="newtheet">theet</a>
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
        <div id="feed">
            <div id="iconChirp">
         <img src="/src/images/icons/search.svg" alt="the opensocial">
            </div>
            <div class="title">
                <p class="selcted">Search</p>
            </div>
            <form id="searchMenu">
                <div id="exploreer">
                    <textarea maxlength="240" placeholder="do u want to find someone?"></textarea>
                </div>
                <div id="exploreTheopensocial">
                    <button type="submit" class="postTheet">search</button>
                </div>
            </form>
            <div class="title">
                <p class="selcted">most theets on</p>
            </div>
            <div id="exploreTrends">
                <div id="trends">
                    <div>
                        <a>the opensocial</a>
                        <p class="subText">0 thees</p>
                    </div>
                    <div>
                        <a>twitter</a>
                        <p class="subText">6 thees</p>
                    </div>
                    <div>
                        <a>iphone 16</a>
                        <p class="subText">86 thees</p>
                    </div>
                </div>
            </div>
            <div class="title">
                <p class="selcted">u should follow</p>
            </div>
            <div id="whoToFollowExplore">
                <div id="whotfollow">
                    <div>
                        <div>
                            <img class="userPic"
                                src="https://pbs.twimg.com/profile_images/1787728519436357632/lq-6wCZD_400x400.jpg" alt="">
                            <div>
                                <p>Filip(CEO) <img class="verified" src="/src/images/icons/verified.svg" alt=""></p>
                                <p class="subText">@bukovinafilip</p>
                            </div>
                        </div>
                        <a class="followButton following">Following</a>
                    </div>
                    <div>
                        <div>
                            <img class="userPic"
                                src="https://pbs.twimg.com/profile_images/1815321848071995392/_dG6Psvo_400x400.jpg" alt="">
                            <div>
                                <p>kocicak99 <img class="verified" src="/src/images/icons/verified.svg" alt=""></p>
                                <p class="subText">@kocicak99</p>
                            </div>
                        </div>
                        <a class="followButton">Follow</a>
                    </div>
                    <div>
                        <div>
                            <img class="userPic"
                                src="/src/images/users/chirp/user.svg" alt="">
                            <div>
                                <p>the opensocial <img class="verified" src="/src/images/icons/verified.svg" alt=""></p>
                                <p class="subText">@theopensocial</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </main>
    <aside id="sideBar">
        <div>
            <p class="subText">Developed by Filip Bukovina. Some code has been forked from Chirp.
<br><br>the opensocial v0.1</p>
        </div>
    </aside>
    <footer>
        <div>
            <a href="/"><img src="/src/images/icons/house.svg" alt="Home"></a>
            <a href="explore" class="active"><img src="/src/images/icons/search.svg" alt="Discover"></a>
            <a href="notifications"><img src="/src/images/icons/bell.svg" alt="Notifications"></a>
            <a href="messages"><img src="/src/images/icons/envelope.svg" alt="Direct Messages"></a>
            <a
                href="<?php echo isset($_SESSION['username']) ? '/user?id=' . htmlspecialchars($_SESSION['username']) : '/signin'; ?>"><img
                    src="/src/images/icons/person.svg" alt="Profile"></a>
        </div>
    </footer>
</body>

</html>