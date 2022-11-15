<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
    <title>FORUM</title>
</head>
<body>
    <div id="wrapper"> 
    
        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
            <header>
                <nav>
                <div id="nav-left">
                        <a href="/AP_exos/Forum/forumPlateau/">Forum<span class="text-muted">.ElanFormation</span></a>
                        
                    </div>
                    <button aria-label="Open menu" class="btn-menu" onclick="myFunction()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="active" style="width: 32px; height: 32px; transform: rotate(0deg);">
                        <line x1="4.8" y1="9.6" x2="27.2" y2="9.6" ></line>
                        <line x1="27.2" y1="22.4" x2="4.8" y2="22.4" ></line>
                    </svg>
                    </button>
                    <div id="nav-right">
                    
                    <?php
                        if(App\Session::getUser()){
                            ?>
                            <a href="index.php?ctrl=security&action=viewProfile&id=<?= App\Session::getUser()->getId() ?>"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()?></a>
                            <?php
                                if(App\Session::isAdmin()){
                                ?>
                                <a href="index.php?ctrl=security&action=listUtilisateurs">Voir la liste des utilisateurs</a>
                                <?php
                            }
                            ?>
                            <a href="index.php?ctrl=forum&action=listTopics">la liste des topics</a>
                            <a href="index.php?ctrl=security&action=logoutUtilisateurs">Déconnexion</a>
                            <?php
                        }
                        else{
                            ?>
                            <a href="index.php?ctrl=security&action=loginUtilisateurs">Connexion</a>
                            <a href="index.php?ctrl=security&action=addUtilisateurs">Inscription</a>
                            <a href="index.php?ctrl=forum&action=listTopics">la liste des topics</a>
                            <a href="index.php?ctrl=forum&action=listCategories">la liste des categories</a>
                            <a href="index.php?ctrl=forum&action=listPosts">la liste des posts</a>
                        <?php
                        }
                    ?>
                    </div>
                </nav>
            </header>
            
            <main id="forum">
                <?= $page ?>
            </main>
        </div>
        <footer>
            <p>&copy; 2020 - Forum CDA - <a href="/home/forumRules.html">Règlement du forum</a> - <a href="">Mentions légales</a></p>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
        </footer>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script>

        $(document).ready(function(){
            $(".message").each(function(){
                if($(this).text().length > 0){
                    $(this).slideDown(500, function(){
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function(){
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            $(".ban-btn").on("click", function(){
                return confirm("Etes-vous sûr de vouloir ban cet utilisateur?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })

        function myFunction() {
        var x = document.getElementById("nav-right");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
        }

        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/
    </script>
</body>
</html>