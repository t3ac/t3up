CKEDITOR.plugins.add( 'codeTag', {
  icons: 'code',
  init: function( editor ) {
    editor.addCommand( 'wrapCode', {
      exec: function( editor ) {
        editor.insertHtml( '<span class="myplant">' + editor.getSelection().getSelectedText() + '</span>' );
      }
    });
    editor.ui.addButton( 'Code', {
      label: 'Wrap span',
      command: 'wrapCode',
      toolbar: 'insert'
    });
  }
});