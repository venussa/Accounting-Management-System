var colors = [ 'red', 'blue', 'white' ];

      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {


        lineNumbers: true,
        lineWrapping: true,
        matchBrackets: true,
        matchTags: {bothTags: true},
        mode: $("#data-type-extention").attr("ext"),
        indentUnit: 4,
        indentWithTabs: true,
        autoCloseTags: true,
        lint: true,
        scrollbarStyle: "simple",
        lint: {
          disableEval: true,
          disableExit: true,
          disabledFunctions: ['proc_open', 'system'],
          deprecatedFunctions: ['wp_list_cats']
        },
        gutters: ["CodeMirror-lint-markers"],
        styleActiveLine: true,
        value: "",
        extraKeys: {

            "Ctrl-S": function(){
              save_project();
            },
            
            "Ctrl-Space": "autocomplete",

            "Ctrl-J": "toMatchingTag",

            'Ctrl-K' : function (cm, event) {
              editor.state.colorpicker.popup_color_picker();
            }

      },

      colorpicker : {
            mode : 'edit',
            hideDelay: 0, 
            type: 'macos',
            onHide: function (color) {
                console.log('hide', color)
            }
        }

      });

    editor.on('blur' , () => {
        console.log('saved')
    })

    setTimeout(function(){
        editor.refresh();
    }, 100);

    editor.on('inputRead', function onChange(editor, input) {
      
      var filter = $("body").attr("path");
      var extention = filter.split(".");
          extention = extention[(extention.length - 1)];

       if (input.text[0] === '#' && extention == "css")

        editor.state.colorpicker.popup_color_picker();
     
       if (input.text[0] === ';' || input.text[0] === ' ' || input.text[0] === '#' ) { return; }
        
        CodeMirror.commands.autocomplete(editor, null, { completeSingle: false });
     
    });