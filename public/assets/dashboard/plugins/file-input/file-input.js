function singleDelete(fieldName) {
    
    let deleteInput = fieldName+"Current";
    $('#'+fieldName+'Viewer').empty();
    document.getElementById(deleteInput).value = 'delete';
}

function multipleDelete(fieldName, value) {
    let viewer = fieldName+"Viewer"+value;
    let currentInput = fieldName+"Current";

    document.getElementById(viewer).remove();
    let old = JSON.parse(document.getElementById(currentInput).value);

    old = old.filter(function(el){ return el !== value });
    document.getElementById(currentInput).value = JSON.stringify(old);
}

function resetFileInput(input) { 
    $('#'+input).val('');
    let viewer = "#"+input+"New";
    $(viewer).empty();
 }

(function( $ ){
    $.fn.fileInput = function(options) {
        if(options.action == 'update'){
            var currentInput = '<input name="'+this.attr('id')+'Current" id="'+this.attr('id')+'Current" type="hidden" value="'+options.value+'">';
            console.log(currentInput);
            $(currentInput).insertBefore(this);
        }
        
        // init
        if(this[0].multiple){
            if(options.action == 'update'){
                var newViewer = "<div class='row' id='"+this.attr('id')+"New'></div>";
                $(newViewer).insertAfter(this);
        
                if($('#'+this.attr('id')+'Current').val() !== ''){
                    var current = JSON.parse($('#'+this.attr('id')+'Current').val());
                    if(current.length !== 0){
                        var newEl = "<div class='row'>";
                        for (let index = 0; index < current.length; index++) {
                            newEl += "<div class='col-3' id='"+this.attr('id')+"Viewer"+current[index]+"'>";
                            newEl += "<div class='files-viewer'>";
                            if(options.type == 'image'){
                                newEl += "<img src='/"+current[index]+"' class='img-thumbnail'>";
                            }
                            else{
                                newEl += "<embed src='/"+current[index]+"' class='img-thumbnail'>";
                            }
                            newEl += "<span onclick='multipleDelete(`"+this.attr('id')+"`,`"+current[index]+"`)'><i class='fa fa-trash-alt'></i></span>"
                            newEl += "</div></div>";
                        }
                        newEl += "</div>";
                        $(newEl).insertAfter(this); 
                    }
                }else{
                    var currentViewer = "<div class='row' id='"+this.attr('id')+"Viewer'></div>";

                    $(currentViewer).insertAfter(this);
                }
            }

            let id = this.attr('id'); 
            // create viewer if not exist
            if($("#"+id+"New").length == 0){
                var el = "<div class='row' id='"+this.attr('id')+"New'></div>";
                $(el).insertAfter(this);
            }
            this.on('change', function(){
                var uploadedFiles = this.files;
                var images = "";
                for (let index = 0; index < uploadedFiles.length; index++) {
                    
                    var src = URL.createObjectURL(uploadedFiles[index]);
                    images += "<div class='col-3'>";
                    images += "<div class='files-viewer'>";
                    if(options.type == 'image'){
                        images += "<img src='"+src+"' class='img-thumbnail'>";
                    }else{
                        images += "<embed src='"+src+"' class='img-thumbnail'>";
                    }
                    images += "</div></div>";
                }

                images += "<div class='col-3'><div class='files-viewer' style='text-align: center'>";
                images += "<P onclick='resetFileInput(`"+id+"`)' class='btn btn-danger' style='margin-top: 35%;'>remove all</P></div></div>";

                $("#"+id+"New").empty();
                document.getElementById(id+"New").innerHTML = images;

            });


        }else{
            if(options.action == 'update'){
                var current = $('#'+this.attr('id')+'Current').val();
                if(current !== ""){
                    var newEl = "<div class='row' id='"+this.attr('id')+"Viewer'>";
                    newEl += "<div class='col-3'>";
                    newEl += "<div class='files-viewer'>";
                    if(options.type == 'image'){
                        newEl += "<img src='/"+current+"' class='img-thumbnail'>";
                    }
                    else{
                        newEl += "<embed src='/"+current+"' class='img-thumbnail'>";
                    }
                    newEl += "<span onclick='singleDelete(`"+this.attr('name')+"`)'><i class='fa fa-trash-alt'></i></span>"
                    newEl += "</div></div></div>";
                    $(newEl).insertAfter(this); 
                }else{
                    var newEl = "<div class='row' id='"+this.attr('id')+"Viewer'></div>";
                    $(newEl).insertAfter(this);
                }
            }

            let id = this.attr('id'); 
            // create viewer if not exist
            if($("#"+id+"Viewer").length == 0){
                var el = "<div class='row' id='"+this.attr('id')+"Viewer'></div>";
                $(el).insertAfter(this);
            }
            this.on('change', function(){
                var uploadedFiles = this.files;
                var image = "";

                var src = URL.createObjectURL(uploadedFiles[0]);
                image += "<div class='col-3'>";
                image += "<div class='files-viewer'>";
                if(options.type == 'image'){
                    image += "<img src='"+src+"' class='img-thumbnail'>";
                }
                else{
                    image += "<embed src='"+src+"' class='img-thumbnail'>";
                }
                image += "</div></div>";
                

                $("#"+id+"Viewer").empty();
                // $(image).appendTo("#"+id+"Viewer");
                document.getElementById(id+"Viewer").innerHTML = image;
            });
    
        }



       return this;
    }; 
 })( jQuery );


