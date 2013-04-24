<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/calendar.css"/>


    <!-- Scripts -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/validator.js"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/jquery.calendario.js"></script>


    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen"/>
    <link rel="stylesheet" href="css/style.css" media="screen"/>

    <title>Calendar Demo</title>
</head>
<body>
<div class="navbar-wrapper">
    <div class="container">
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".new-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="brand">Project</a>

                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li class="active">
                            <a href="project/createUser.html">Create User</a>
                        </li>

                        <li class="active">
                            <a href="project/userEntryTest.html">User Entry Test</a>
                        </li>

                        <li class="active">
                            <a href="project/login.html">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div id="calendar" class="fc-calendar-container"></div>

</div>
<!-- /container -->

<script type="text/javascript">
    $('#calendar').calendario();
</script>

</body>
</html>