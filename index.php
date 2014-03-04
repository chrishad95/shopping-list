<html data-ng-app="shoppingListApp">
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.0/jquery.mobile.min.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.0/jquery.mobile.min.js"></script>

<script src="lib/angular/angular.js"></script >
<script src="js/controllers.js"></script>

</head>
<body ng-controller='MainController'>

<div data-role="page" id="page1">
    <div data-theme="a" data-role="header">
        <h3>
Shopping Lists
        </h3>
		<a href="#add-list" data-icon="add" class="ui-btn-right">New</a>
    </div>
    <div data-role="content">
        <ul data-role="listview" data-divider-theme="b" data-inset="true">
            <li data-role="list-divider" role="heading">
                divider
            </li>
	    
            <li data-ng-repeat="list in lists" data-theme="c">
				<a href='#list-detail' ng-click='showList(list.id)' data-transition="slide">{{ list.name }}</a>
            </li>	    

        </ul>
    </div>
</div>
<div data-role="page" id="list-detail">
    <div data-theme="a" data-role="header">
        <a data-role="button" href="#page1" class="ui-btn-left">
            Shopping Lists
        </a>
        <h3>
		{{selectedList.name}}
        </h3>
		<a href="#add-item" data-icon="add" class="ui-btn-right">New Item</a>
    </div>
    <div data-role="content">
        <ul data-role="listview" id="item-list"  data-divider-theme="b" data-inset="true">
            <li data-role="list-divider" role="heading">
                divider
            </li>
	    
            <li class="ui-last-child" data-ng-repeat="item in items" data-theme="c" repeat-done="">
				<a class="ui-btn ui-btn-c ui-btn-icon-right ui-icon-carat-r" href='#list-detail' ng-click='selectItem(item.id)' data-transition="slide">{{item.name}}</a>
			</li>	    

        </ul>
    </div>
</div>
<div data-role="page" id="add-list">
    <div data-theme="a" data-role="header">
        <a data-role="button" href="#page1" class="ui-btn-left">
			Shopping Lists
        </a>
		<a href="#page1" data-icon="add" class="ui-btn-right" ng-click='addList()' >Done</a>
        <h3>
		New Shopping List
        </h3>
    </div>
    <div data-role="content">
	    <div data-role="fieldcontain">
		<input name="list_name" id="list_name" placeholder="List Name" value="" ng-model="newList.name">
	    </div>
    </div>
</div>
<div data-role="page" id="add-item">
    <div data-theme="a" data-role="header">
        <a data-role="button" href="#list-detail" class="ui-btn-left">
			{{selectedList.name}}
        </a>
        <h3>
		New Item
        </h3>
		<a href="#list-detail" data-icon="add" class="ui-btn-right" ng-click='addItem()' >Done</a>
    </div>
    <div data-role="content">
	    <div data-role="fieldcontain">
		<input name="item_name" id="item_name" placeholder="Item Name" value="" ng-model="newItem.name">
	    </div>
    </div>
</div>

</body>
</html>
