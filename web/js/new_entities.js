$(document).ready(function() {
    var ul = {
        'tag':'ul.new_tag',
        'author':'ul.new_author',
        'actor': 'ul.new_actor'};

    for (var el in ul) {
        if ($(ul[el]).length) {
            var collectionHolder = $(ul[el]);

            var $addTagLink = $('<a href="#" class="add_' + el + '_link">Add ' + el + '</a>');

            var $newLinkLi = $('<li></li>').append($addTagLink);

            collectionHolder.append($newLinkLi);
            collectionHolder.data('index', collectionHolder.find(':input').length);

            addClick($addTagLink, collectionHolder, $newLinkLi);
        }
    }
});

function addClick($addTagLink, collectionHolder, $newLinkLi) {
    $addTagLink.on('click', function(e) {
        e.preventDefault();

        addTagForm(collectionHolder, $newLinkLi);
    });
}

function addTagForm(collectionHolder, $newLinkLi) {
    var prototype = collectionHolder.data('prototype');
    // get the new index
    var index = collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var prototype = prototype.replace(/__name__label__/g, '');
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm + '<a href="#" class="delete_row">[x]</a>');
    $newLinkLi.before($newFormLi);

    $('.delete_row').on('click', function(e) {
        e.preventDefault();

        $(this).closest('li').remove();
    });
}