<?php
include "./connection.php";
session_start();

if (!isset($_SESSION['user'])) {
  header('location:connection.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
  $id = $_SESSION['user'];
  $sql = $conn->prepare("SELECT * FROM `user` WHERE `id`='$id'");
  $sql->execute();
  $fetch = $sql->fetch();
  ?>
    <script>
    (function() {
        // removing the message 3 seconds after the page load
        setTimeout(function() {
            document.getElementById('welcome').remove();
        }, 2000)
    })();
    </script>
    <div class="container">
        <div class="user">
            <h3 id="welcome">Welcome</h3>
            <h4><?php echo $fetch['username'] ?></h4>
        </div>
    </div>
    <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $em = '';
            extract($_POST);

                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO projet(id_user, objectif) VALUES (:id, :objectif)";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(
                    ':id' => $id,
                    ':objectif' => $objectifText
                ));
                header('location: home.php');
            }
?>
    <div class="container-md testimonial-grid">
        <div class="card text-white bg-primary mb-4 grid-1">
            <div class="card-header">Objectif</div>
            <div class="card-body">
                <h5 class="card-title">Primary card title</h5>
                <p class="card-text">
                    <button class="learn-more" data-bs-toggle="modal" data-bs-target="#objectif-modal"
                        data-bs-whatever="@mdo">
                        <span class="circle" aria-hidden="true">
                            <span class="icon arrow"></span>
                        </span>
                        <span class="button-text">Learn More</span>
                    </button>
                </p>
            </div>
        </div>
        <div class="modal fade" id="objectif-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Recipient:</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="objectif-text" name="objectifText" rows="10"></textarea>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="send" class="btn btn-primary" id="submit-objecif">Send message</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
        <div class="card text-white bg-secondary mb-4 grid-2">
            <div class="card-header">Expose</div>
            <div class="card-body">
                <h5 class="card-title">Secondary card title</h5>
                <p class="card-text">
                    <button class="learn-more" data-bs-toggle="modal" data-bs-target="#expose-modal"
                        data-bs-whatever="@mdo">
                        <span class="circle" aria-hidden="true">
                            <span class="icon arrow"></span>
                        </span>
                        <span class="button-text">Learn More</span>
                    </button>
                </p>
            </div>
        </div>
        <div class="modal fade" id="expose-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Recipient:</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="objectif-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submit-expose">Send message</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card text-white bg-success mb-3 grid-3">
            <div class="card-header">Third</div>
            <div class="card-body">
                <h5 class="card-title">Success card title</h5>
                <p class="card-text">
                    <button class="learn-more" data-bs-toggle="modal" data-bs-target="#expose-modal"
                        data-bs-whatever="@mdo">
                        <span class="circle" aria-hidden="true">
                            <span class="icon arrow"></span>
                        </span>
                        <span class="button-text">Learn More</span>
                    </button>
                </p>
            </div>
        </div>
        <div class="card text-dark bg-light mb-3 grid-4">
            <div class="card-header">Fourth</div>
            <div class="card-body">
                <h5 class="card-title">Light card title</h5>
                <p class="card-text">
                    <button class="learn-more" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="@mdo">
                        <span class="circle" aria-hidden="true">
                            <span class="icon arrow"></span>
                        </span>
                        <span class="button-text">Learn More</span>
                    </button>
                </p>
            </div>
        </div>
        <div class="card text-white bg-dark mb-3 grid-5">
            <div class="card-header">Fifth</div>
            <div class="card-body">
                <h5 class="card-title">Light card title</h5>
                <p class="card-text">
                    <button class="learn-more" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="@mdo">
                        <span class="circle" aria-hidden="true">
                            <span class="icon arrow"></span>
                        </span>
                        <span class="button-text">Learn More</span>
                    </button>
                </p>
            </div>
        </div>
    </div>
</body>

</html>