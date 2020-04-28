<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>MyJournal</title>
        <link href="https://fonts.googleapis.com/css?family=Cousine:400" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/site.css">
    </head>
    <body>
      <?php
        include "inc/functions.php";

        if(isset($_POST['delete'])) {
           if(project_delete(filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT))){
              header('location: index.php');
              exit;
           }
        }
      ?>
        <header>
            <div class="container">
                <div class="site-header">
                    <a class="logo" href="index.php"><i class="material-icons">library_books</i></a>
                    <a class="button icon-right" href="new.php"><span>New Entry</span> <i class="material-icons">add</i></a>
                </div>
            </div>
        </header>
        <section>
            <div class="container">
                <div class="entry-list">
                  <?php   
                    foreach(get_project_list() as $entries) {
                      echo "<article>
                             <h2><a href='detail.php?id=".$entries["id"]."'>".$entries["title"]."</a></h2>
                             <time datetime=". $entries["date"].">".date("F j, Y",strtotime($entries["date"]))."</time>
                         <form method = 'post' action = 'index.php'>
                         <input type = 'hidden' value='".$entries["id"]."' name = 'delete'/>
                         <input type = 'submit' value = 'Delete' style='background: transparent;
                         border: none; color: red;'/>
                         </form>
                         </article>";
                    }
                    ?>
<!--
                    <article>
                        <h2><a href="detail.php">The best day I’ve ever had</a></h2>
                        <time datetime="2016-01-31">January 31, 2016</time>
                    </article>
-->
<!--
                    <article>
                        <h2><a href="detail_2.html">The absolute worst day I’ve ever had</a></h2>
                        <time datetime="2016-01-31">January 31, 2016</time>
                    </article>
                    <article>
                        <h2><a href="detail_3.html">That time at the mall</a></h2>
                        <time datetime="2016-01-31">January 31, 2016</time>
                    </article>
                    <article>
                        <h2><a href="detail_4.html">Dude, where’s my car?</a></h2>
                        <time datetime="2016-01-31">January 31, 2016</time>
                    </article>
-->
                </div>
            </div>
        </section>
        <footer>
            <div>
                &copy; MyJournal
            </div>
        </footer>
    </body>
</html>