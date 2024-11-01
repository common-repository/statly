
$(document).ready(function () {
    $("#addEvent").click(function () {
        var eventModal     = $("#addEventModal");
        $("#category").val('');
        $("#inputName").val('');
        $("#inputUrl").val('');    
        $("#inputValue").val('');    
        $("#inputDescription").val('');    
        $("#inputIsGoal").prop('checked', false);   
        eventModal.modal('show');
    });
    var pages = document.querySelectorAll('#wp-pages .btn');
    for (var i = 0, n = pages.length; i < n; i++) {
        var page = pages[i];
        page.draggable = true;
        page.onselectstart = function(e) {
            e.preventDefault();
            e.target.dragDrop();
        };

        page.ondragstart = function(e) {
            e.dataTransfer.setData('Text', e.target.innerHTML);
            e.dataTransfer.setData('page_link', $(e.target).attr('page_link'));
        };
    };
    
    
    
    var droppables = document.getElementsByClassName('event-cat');
    for (var i = 0, n = droppables.length; i < n; i++) {
        var droppable = droppables[i];
        droppable.ondragenter = function(e) {
        };

        droppable.ondragover = function(e) {
            e.preventDefault(); // Allows the drop.
        };

        droppable.ondragleave = function(e) {
            // e.target.classList.remove('over');
        };

        droppable.ondrop = function(e) {
            var cat_id = $(this).find(".cat-name").attr('val');
            e.preventDefault(); // FF freaks out without this.
            
            var page_name = e.dataTransfer.getData('Text');
            var page_link = e.dataTransfer.getData('page_link');
            $("#category").val(cat_id);
            $("#inputName").val(page_name);
            $("#inputUrl").val(page_link);
            $("#inputValue").val('');    
            $("#inputDescription").val(''); 
            $("#inputIsGoal").prop('checked', false);  
            $("#addEventModal").modal('show');
        };
    };
    
    
});
function ShowLoading() {
    $('.loading-section').css('display', 'block');
    return true;
}