function createCkEditor(elem) {
    CKEDITOR.plugins.add('dialogDash', {
        icons: 'https://raw.githubusercontent.com/ckeditor/ckeditor-docs-samples/master/tutorial-timestamp/timestamp/icons/timestamp.png',
        init: function( editor ) {
            editor.addCommand( 'dialogDash', {
                exec: function( editor ) {
                    var now = new Date();
                    editor.insertHtml( '—' );
                }
            });
            editor.ui.addButton( 'DialogDash', {
                label: 'Raya de dialogo',
                command: 'dialogDash',
                toolbar: 'insert'
            });
        }
    });

    CKEDITOR.replace(elem, {
        plugins: 'mentions,basicstyles,undo,link,wysiwygarea,toolbar,dialogDash',
        contentsCss: [
            'https://cdn.ckeditor.com/4.12.1/full-all/contents.css',
            'https://ckeditor.com/docs/vendors/4.12.1/ckeditor/assets/mentions/contents.css'
        ],
        height: 200,
        extraPlugins: 'dialogDash',
        toolbar: [
            {name: 'document', items: ['Source', 'Undo', 'Redo']},
            {name: 'basicstyles', items: ['Bold', 'Italic', 'Strike','Blockquote', 'DialogDash', '-']},
            {name: 'paragraph', items: ['Blockquote']}
        ],
        mentions: [{
            feed: madeMention,
            itemTemplate: '<li data-id="{id}" class="mention-li">' +
                '<img class="mention-image" src="{image}" />' +
                '<div class="mention-data">' +
                '<span class="mention-right">{type}</span>' +
                '<span class="mention-slug">{name}</span>' +
                '<span class="mention-name">{tag}</span>' +
                '</div>' +
                '</li>',
            outputTemplate: '@{tag}',
            minChars: 3
        }]
    });

    function madeMention(opts, callback) {
        axios.defaults.baseURL = window.location.origin;
        console.log(axios.defaults.baseURL);
        axios.get('api/autocomplete?search=' + opts.query).then(res => {
            var data = res.data.tags.map(tag => {
                return {
                    id: tag.id,
                    name: tag.name,
                    image: tag.taggable.image,
                    type: tag.taggable.type,
                    tag: tag.tag
                }
            });
            console.log(data);
            callback(data);
        });
    }
}