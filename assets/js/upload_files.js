			var Dropzone = require("enyo-dropzone");
			Dropzone.autoDiscover = false;
			var previewNode = document.querySelector("#template1");
            previewNode.id = "";
            var previewTemplate = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode);
            
            var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
              url: "http://localhost/demo/upload.html", // Set the url
              thumbnailWidth: 80,
              thumbnailHeight: 80,
              parallelUploads: 20,
              previewTemplate: previewTemplate,
              autoQueue: false, // Make sure the files aren't queued until manually added
              previewsContainer: "#previews1", // Define the container to display the previews
              clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
            });
            
            myDropzone.on("addedfile", function(file) {
              // Hookup the start button
              file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
            });
            
            /*// Update the total progress bar
            myDropzone.on("totaluploadprogress", function(progress) {
              document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
            });*/
            
            myDropzone.on("sending", function(file) {
              // Show the total progress bar when upload starts
              //document.querySelector("#total-progress").style.opacity = "1";
              // And disable the start button
              file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
            });
            
            // Hide the total progress bar when nothing's uploading anymore
            /* myDropzone.on("queuecomplete", function(progress) {
              document.querySelector("#total-progress").style.opacity = "0";
            }); */