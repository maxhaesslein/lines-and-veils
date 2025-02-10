(function(){

	var isModified = false;

	function init(){

		for( var input of document.querySelectorAll('input[type="radio"]') ) {
			input.addEventListener('change', function(){
				isModified = true;
				this.closest('tr').classList.add('edited');
			});
		}

		var form = document.querySelector('form');
		form.addEventListener('submit', function(){
			isModified = false;
		});

		var addTopic = document.getElementById('add-topic');
		if( addTopic ) {
			addTopic.addEventListener('click', function(e){
				e.preventDefault();

				var newTopic = document.getElementById('new-topic');

				var topic = newTopic.value.trim();

				if( ! topic ) return;

				var id = topic.toLowerCase().replace(' ', '_').replace(/[^a-z0-9_]+/g, "");

				var newHTML = '<input type="hidden" name="'+id+'" value="'+topic+'"><tr class="edited"><td class="line"><input type="radio" name="topic_'+id+'" title="Line" value="line"></td><td class="veil"><input type="radio" name="topic_'+id+'" title="Veil" value="veil"></td><td class="okay"><input type="radio" name="topic_'+id+'" title="Okay" value="okay" checked></td><td class="topic">'+topic+'</td></tr>';

				var emptySpace = document.getElementById('new-topic-line');
				emptySpace.insertAdjacentHTML('beforebegin', newHTML);

				newTopic.value = '';

			});
		}

	}	
	document.addEventListener( 'DOMContentLoaded', init, false );



	window.addEventListener('beforeunload', function(event){
		if( ! isModified ) return;
		event.preventDefault();
		event.returnValue = ''; // needed for some browsers
	});


})();