jQuery(document).ready(function() {
    var $tagsCollectionHolder = $('div.element');
    // add a delete link to all of the existing tag form li elements
    $tagsCollectionHolder.find('div.subform').each(function() {
        addImageFormDeleteLink($(this));
    });
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $tagsCollectionHolder.data('index', $tagsCollectionHolder.find('input').length);

    $('body').on('click', '.add_item_link', function(e) {
        var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass'); // 'element'
        // add a new tag form (see next code block)
        addFormToCollection($collectionHolderClass);
    })
    function addFormToCollection($collectionHolderClass) {
        // Get the ul that holds the collection of tags
        var $collectionHolder = $('.' + $collectionHolderClass); // $('.element')

        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype'); // form_widget(form.images.vars.prototype)

        // get the new index
        var index = $('#widgets-counter').val(); // 1 ça va s'incrementer

        var newForm = prototype;
        // You need this only if you didn't set 'label' => false in your tags field in TaskType
        // Replace '__name__label__' in the prototype's HTML to
        // instead be a number based on how many items we have
        // newForm = newForm.replace(/__name__label__/g, index);

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, index);

        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormLi = $('<div class="subform mt-2 d-flex"></div>').append(newForm);
        // Add the new form at the end of the list
        $collectionHolder.append($newFormLi);

        updateCounter();

            // add a delete link to the new form
        addImageFormDeleteLink($newFormLi);
    }
    function addImageFormDeleteLink($imageFormDiv) {
        var $removeFormButton = $('<div><button type="button" class="btn btn-danger ml-2">X</button></div>');
        $imageFormDiv.append($removeFormButton);

        $removeFormButton.on('click', function(e) {
            // remove the li for the tag form
            $imageFormDiv.remove();
            updateCounter();
        });
    }

    function updateCounter() {
        const count = +$('#widgets-counter').val() + 1;

        $('#widgets-counter').val(count);
    }

    $('.js-delete').on('click', function() {
        let imageId = $(this).data('id');

        // requete ajax
        $.ajax({
        type: 'POST',
        url: '/supprime/image/ad/effacer',
        data: {'image_id': imageId},
        success: function(data) {
            if (data.success) {
                $('.js-delete').closest('#'+imageId).remove();
            } else {
                $('.js-delete').closest('#'+imageId).append('<div class="alert alert-danger">Cant delete image</div>');
            }
        },
        error: function(data) {
            $('.js-delete').closest('#'+imageId).append('<div class="alert alert-danger">Une erreur est survenue</div>')
        }
        });
    });
});