<html ng-app="ppma">
<head>
    <link href="vendor/semantic/dist/semantic.min.css" rel="stylesheet" type="text/css">
    <link href="css/site.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="ui container">

    <div class="ui secondary pointing menu">
        <a href="#/" class="item"><i class="tasks icon"></i> Entries</a>
        <a href="#/categories" class="active item"><i class="folder open icon"></i> Categories</a>
        <a href="#/" class="item"><i class="tags icon"></i> Tags</a>
        <a href="#/" class="item"><i class="settings icon"></i> Settings</a>
        <a href="#/" class="item"><i class="sign out icon"></i> Logout</a>

        <div class="right menu">
            <div class="item">
                <div class="ui transparent icon input">
                    <input type="text" placeholder="Search...">
                    <i class="search link icon"></i>
                </div>
            </div>
        </div>
    </div>

    <div ng-view></div>

</div>

<script src="vendor/jquery/dist/jquery.min.js"></script>
<script src="vendor/semantic/dist/semantic.min.js"></script>
<script src="vendor/angular/angular.js"></script>
<script src="vendor/angular-route/angular-route.min.js"></script>
<script src="vendor/angular-resource/angular-resource.min.js"></script>
<script src="js/app.js"></script>
<script src="js/category/config.js"></script>
<script src="js/category/dao.js"></script>
<script src="js/category/create-controller.js"></script>
<script src="js/category/index-controller.js"></script>
<script src="js/category/update-controller.js"></script>
<script src="js/category/directive/form.js"></script>
<script src="js/dao/service.js"></script>
</body>
</html>