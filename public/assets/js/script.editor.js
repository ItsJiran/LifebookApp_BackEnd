
let journal_data = {};
if( $('#journal-data')[0] !== undefined){
    journal_data = JSON.parse( $('#journal-data')[0].content );
    if(journal_data == '') journal_data = {};
}

const editor = new EditorJS({
    holder:'journal-editor',

    tools:{
        /*image:{
            class: ImageTool,
            inlineToolbar:true,
            config:{
                byFile:'/upload/images/journal',
                byUrl:'/upload/images/journal',
            }
},*/
        header:{
            class:Header,
            inlineToolbar:true,
        },
        checklist:{
            class:Checklist,
            inlineToolbar:true,
        },
        paragraph:{
            class:Paragraph,
            inlineToolbar:true,
        },
        list:{
            class:List,
            inlineToolbar:true,
        }
    },

    data:journal_data,
    placeholder:'Tulis Di Sini!'
});

// === FUNCTION
function createJournal(){
    if(ajax_status) return;
    toggleAjaxStatus();

    let title = $('#input-journal-title')[0].value;
    let date = $('#input-journal-date')[0].value;
    let time = $('#input-journal-time')[0].value;

    editor.save().then((data)=>{

        $.ajax({
            url:'/post/journals',
            method:'post',
            headers:{
                Accept:'application/json',
                'X-CSRF-TOKEN':csrf.attr('content'),
            },
            data:{
                title:title,
                date:date,
                time:time,
                editor_data:data,
            },
            success:(res)=>{
                alert(` ${res['message']} `);
                window.location.href = '/journal';
            },
            error:(res)=>{
                var response = res.responseJSON;
                alert(`
                    Gagal Melakukan Penambahan \n
                    ${response['message']}
                `);
            },
            complete:(res)=>{
                toggleAjaxStatus();
            }
        });

    }).catch((error)=>{
        console.log('Saving Failed : ', error);
    });
}
function saveJournal(){
    if(ajax_status) return;
    toggleAjaxStatus();

    let id = $('#journal-id')[0].content;
    let user_id = $('#journal-user-id')[0].content;

    editor.save().then((data)=>{
        console.log(data);

        $.ajax({
            url:'/put/journals',
            method:'put',
            headers:{
                Accept:'application/json',
                'X-CSRF-TOKEN':csrf.attr('content'),
            },
            data:{
                id:id,
                user_id:user_id,
                editor_data:data,
            },
            success:(res)=>{
                alert(` ${res['message']} `);
            },
            error:(res)=>{
                var response = res.responseJSON;
                alert(`
                    Gagal Melakukan Perubahan \n
                    ${response['message']}
                `);
            },
            complete:(res)=>{
                toggleAjaxStatus();
            }
        });

    }).catch((error)=>{
        console.log('Saving Failed : ', error);
    });
}

console.log('test');
