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
 
        if(isset($_GET["id"])) {
           $id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
        }

          if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = trim(filter_input(INPUT_POST, 'entryid', FILTER_SANITIZE_NUMBER_INT));
            $title = trim(filter_input(INPUT_POST,'title', FILTER_SANITIZE_STRING));
            $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
            $time_spent = trim(filter_input(INPUT_POST, 'timeSpent', FILTER_SANITIZE_STRING));
            $learned = trim(filter_input(INPUT_POST, 'whatILearned', FILTER_SANITIZE_STRING));
            $resources = trim(filter_input(INPUT_POST, 'ResourcesToRemember', FILTER_SANITIZE_STRING));
           
            if(!empty($title) || !empty($date) || !empty($time_spent) || !empty($learned) || !empty($resources)){
               if(add_project($title,$date,$time_spent,$learned,$resources,$id)) {
                  header('Location: index.php');
                  exit;
               }
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
                <div class="edit-entry">
                    <h2>Edit Entry</h2>
                    <form method = "post" action = "edit.php">
                      <?php 
                         $store = get_project($id);
                      ?>
                        <input type = "hidden" value = "<?php echo $id?>" name="entryid"/>
                        <label for="title"> Title</label>
                        <input id="title" type="text" name="title" value="<?php echo $store[0]["title"] ?>"/><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" name="date" value="<?php echo $store[0]["date"] ?>"><br>
                        <label for="time-spent"> Time Spent</label>
                        <input id="time-spent" type="text" name="timeSpent" value="<?php echo $store[0]["time_spent"] ?>"><br>
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="whatILearned"><?php echo $store[0]["learned"] ?></textarea>
                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember"><?php echo $store[0]["resources"] ?></textarea>
                        <input type="submit" value="Publish Entry" class="button">
                        <a href="#" class="button button-secondary">Cancel</a>
                    </form>
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