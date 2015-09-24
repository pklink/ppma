<html ng-app="ppma">
<head>
    <link href="vendor/semantic/dist/semantic.min.css" rel="stylesheet" type="text/css">
</head>

<body ng-controller="AppController">



<div class="ui container">

    <div class="ui secondary pointing menu">
        <a class="item">
            <i class="tasks icon"></i> Entries
        </a>
        <a class="active item">
            <i class="folder open icon"></i> Categories
        </a>
        <a class="item">
            <i class="tags icon"></i> Tags
        </a>
        <a class="item">
            <i class="settings icon"></i> Settings
        </a>
        <a class="item">
            <i class="sign out icon"></i> Logout
        </a>
        <div class="right menu">
            <div class="item">
                <div class="ui transparent icon input">
                    <input type="text" placeholder="Search...">
                    <i class="search link icon"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="ui top attached segment">
        <h3 class="ui column header">
            <i class="folder open icon"></i>
            <div class="content">
                Categories
            </div>
        </h3>
    </div>

    <div class="ui bottom attached segment">

        <table class="ui very basic fixed table">
            <thead>
            <tr>
                <th>Name</th>
                <th class="two wide">&nbsp;</th>
                <th class="three wide">&nbsp;</th>
                <th class="two wide">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Shops</td>
                <td>has <a>15 entries</a></td>
                <td>has <a>2 subcategories</a></td>
                <td class="right aligned">
                    <a href="#d"><i class="bordered plus icon"></i></a>
                    <a href="#d"><i class="bordered write icon"></i></a>
                    <a href="#d"><i class="bordered trash icon"></i></a>
                </td>
            </tr>
            </tbody>
        </table>

    </div>

</div>

<script src="vendor/jquery/dist/jquery.min.js"></script>
<script src="vendor/semantic/dist/semantic.min.css"></script>
<script src="vendor/angular/angular.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>