Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element
   // The configuration we've talked about above
  autoProcessQueue: false,
  uploadMultiple: false,
  maxFiles: 1,

  // The setting up of the dropzone
  init: function() {
    var myDropzone = this;
    // First change the button to actually tell Dropzone to process the queue.
    this.element.querySelector("input[type=submit]").addEventListener("click", function(e) {
      // Make sure that the form isn't actually being sent.
      e.preventDefault();
      e.stopPropagation();
      
      $('.save-changes').addClass('hidden');
      $('.loading').removeClass('hidden');
      
      myDropzone.processQueue();
      
    });
    // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
    // of the sending event because uploadMultiple is set to true.
    this.on("sendingmultiple", function() {
      // Gets triggered when the form is actually being sent.
      // Hide the success button or the complete form.
    });
    this.on("success", function(files, response) {
      window.location.href = '/products';
    });
    this.on("error", function(files, response) {
      $('.save-changes').removeClass('hidden');
      $('.loading').addClass('hidden');
      $('.alert').removeClass('hidden');
      
      this.removeAllFiles();
      for(var i in response){
        $('.errors').append('<span>'+response[i][0]+'</span><br />');
      }
    });
    this.on("errormultiple", function(files, response) {
      // Gets triggered when there was an error sending the files.
      // Maybe show form again, and notify user of error
    });
    this.on("maxfilesexceeded", function(file) {
        this.removeAllFiles();
        this.addFile(file);
    });
  }

}

