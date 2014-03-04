
var shoppingListApp = angular.module('shoppingListApp',[], function($httpProvider) {

});

shoppingListApp.directive('repeatDone', function () {
    return function (scope, element, attrs) {
        // When the last element is rendered
        if (scope.$last) { 
            element.parent().parent().trigger('create');
			$("#item-list").trigger("create");	
        }
    }
});


shoppingListApp.controller('MainController', function ($scope, listsFactory) {
	$scope.selectedList = {};
	$scope.selectedListId = "";

	$scope.selectedItem = "";

	$scope.newItem = {};

	$scope.items = [];
	$scope.item_names = [];

	$scope.lists = [];


	$scope.showList = function (id) {
		$scope.selectedListId = id;
  		listsFactory.getLists($scope.selectedListId).then( function(data) {
  		    $scope.selectedList = data[0];
  		});
  		listsFactory.getItems($scope.selectedListId).then( function(data) {
  		    $scope.items = data;

  		});

	};
	$scope.selectItem = function(id) {
		$scope.selectedItem = id;
	}

	$scope.addList = function () {
  		listsFactory.createList($scope.newList.name).then( function(data) {
  		    $scope.lists = data;
  		});


		
	};

	$scope.addItem = function (name) {
  		listsFactory.createItem($scope.selectedList.id, $scope.newItem.name).then( function(data) {
  		    $scope.items = data;
  		});
		
	};

  listsFactory.getLists().then( function(data) {
      $scope.lists = data;
  });
  listsFactory.getItems().then( function(data) {
      $scope.items = data;
  });
});

shoppingListApp.factory('listsFactory', function ($http) {

  return {
      getLists: function() {
			return $http.get('model/lists.php').then(function(result) {
				return result.data;
			});
      },
      getLists: function(id) {
			return $http.get('model/lists.php', {params: {'id': id}}).then(function(result) {
				return result.data;
			});
      },
      getItems: function() {
			return $http.get('model/items.php').then( function(result) {
				return result.data;
			});
      },
      getItems: function(list_id) {
			return $http.get('model/items.php', {params: {'list_id': list_id }}).then( function(result) {
				return result.data;
			});
      },
      createItem: function(list_id, name) {
	  		return $http.put('model/items.php', {data: {'list_id': list_id, 'name': name}} ).then( function(result) { 
				return result.data 
			}); ;
      },
      createList: function(name) {
	  		return $http.put('model/lists.php', {data: {'name': name}} ).then( function(result) { 
				return result.data 
			}); ;
      },
  };

});


