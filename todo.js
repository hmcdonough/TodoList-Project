function xhr(method, urlEnd) {
	var xhr = new XMLHttpRequest();
	xhr.open(method, "http://recruiting-api.nextcapital.com/users/" + urlEnd, true);
	xhr.setRequestHeader( 'Content-Type', 'application/json' );
}

function xhrLogin(email, password) {
	xhr("POST", "sign_in");
	makeSession(email, password);
}

function xhrNewUser(email, password) {
	xhr("POST", "users");
	makeUser(email, password);
}

function xhrGet() {
	xhr("GET", Todo.user.id +"/todos.json?api_token=" + Todo.user.api_token);
	getTodos(Todo.user.id, Todo.user.api_token);
}

function xhrCreate(description) {
	xhr("POST", Todo.user.id +"/todos");
	create(description);
}

function xhrUpdate(todoId, is_complete, description, updateDesc) { 
	var tempTodo;
	if (updateDesc) {
		tempTodo = {
		    "description": description,
		    "id": todoId,
		    "is_complete": is_complete
		}
	} else {
		tempTodo = {
		    "description": description,
		    "id": todoId,
		    "is_complete": !is_complete
		}
	}
	xhr("PUT", Todo.user.id +"/todos/" + todoId);
	updateTodo(Todo.user.id, Todo.user.api_token, tempTodo);
}

function xhrLogout() {
	xhr("DELETE", "sign_out");
	endSession(Todo.user.id, Todo.user.api_token);
}

function makeSession(email, password) {
	Todo.startSession({
	    email:    email,
	    password: password,
	    success: function(user) {
	    	Todo.user = user; 
	    	xhrGet();
	    },
	    error: function(xhrSignIn)  { 
	    	window.location.href = 'http://students.washington.edu/hmcd311/public/start.php'; }
	});
}

function makeUser(email, password) {
	Todo.createUser({
    	email:    email,
	    password: password,
	    success: function(user) { 
	    	Todo.user = user; 
	    	xhrGet(); 
	    },
	    error: function(xhr)  { 
	    	window.location.href = 'http://students.washington.edu/hmcd311/public/start.php'; }
	  });
}

function getTodos(user_id, api_token) {
	Todo.loadTodos({
		success: function(todos) { 
			createList(todos);
		},
	    error: function(xhr)   { alert('todo load error!') }
	});
}

function create(description) {
	Todo.createTodo({
	    todo: {
	      description: description,
	      is_complete: false
	    },
	    success: function(todo) { 
	    	document.getElementById("desc").value = "";
			xhrGet(); 
	   	}, 
	   	error: function()     { alert('todo create error!') }
	});
}

function updateTodo(user_id, api_token, todo) {
	Todo.updateTodo({
	      todoId: todo.id,
	      data: {
	      		description: todo.description,
	      		is_complete: todo.is_complete
	      	},
	      success: function(todo) { 
	      	xhrGet();
	      },
	      error: function(xhr)  { alert('todo update error!') }
	});
}

function endSession(user_id, api_token) {
	Todo.endSession({
        success: function(todo) { 	
      		window.location.href = 'http://students.washington.edu/hmcd311/public/start.php';
		    },
        error:   function(xhr)  { alert('logout error!') }
    });
}

//Manipulates DOM to display Todos in a list
function createList(todos) {
	document.getElementById("main").remove();
	var main = document.createElement("div");
	main.id = "main";
	document.getElementById("container")
		.appendChild(main);

	var ul = document.createElement("ul");
	ul.id = "sortable";
	document.getElementById("main")
		.appendChild(ul);

	for(var i = 0; i < todos.length; i++) {
		var li = document.createElement("li");
		li.id = "todo" + todos[i].id;
		li.className = "ui-state-default";
		li.innerHTML = todos[i].description;

		if (todos[i].is_complete) {
			li.className += " finished";
			var buttonRedo = document.createElement("button");
			buttonRedo.className = "redoButton";
			buttonRedo.className += " i";
			buttonRedo.id = todos[i].id;
			buttonRedo.innerHTML = "Redo";
			buttonRedo.onclick = clickRedo;
			li.appendChild(buttonRedo);
		} else {
			var buttonComplete = document.createElement("button");
			buttonComplete.className = "completeButton";
			buttonComplete.className += " i";
			buttonComplete.id = todos[i].id;
			buttonComplete.innerHTML = "Complete";
			buttonComplete.onclick = click;
			li.appendChild(buttonComplete);
		}

		var buttonUpdate = document.createElement("button");
		buttonUpdate.className = "updateButton";
		buttonUpdate.className += " i";
		buttonUpdate.innerHTML = "Edit";
		buttonUpdate.id = todos[i].id;
		buttonUpdate.onclick = edit;
		li.appendChild(buttonUpdate);	

		document.getElementById("sortable").appendChild(li);
	}
	sortable();
}

function click() {
	xhrUpdate(this.id, false, this.is_complete, false);
}

function clickRedo() {
	xhrUpdate(this.id, true, this.is_complete, false);
}

//gives the user an input prompt to make update a todo's description
function edit() {
	var desc = prompt("Please enter a new description for this task", "description");
	if (desc != null) {
		xhrUpdate(this.id, this.is_complete, desc, true);
	}
}

function callXhr() {
	xhrCreate(document.getElementById("desc").value);
}

window.onload = function() {
     document.getElementById('addButton').onclick=callXhr;
     document.getElementById('logout').onclick=xhrLogout;
}

//Makes the list able to be sorted by clicking and dragging
function sortable() {
	$('#sortable').sortable({
        tolerance: 'touch',
        drop: function () {
            alert('delete!');
        }
			});
	$('#todo').sortable();
};