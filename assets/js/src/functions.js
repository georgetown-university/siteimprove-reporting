// Click event for the "Get current data" button.
$('#getCurrentData').click(function() {
  $(this).attr('disabled', 'disabled').html('Fetching current issue data');

  $.ajax({
   url: 'actions/get_current_issues.php',
   success: function(data) {
     $('#getCurrentData').removeClass('btn-primary').addClass('btn-secondary').html('Issue data is up-to-date!');
   }
  });
});

//
$('#selectSite').change(function() {
  let site = this.value;

  $.ajax({
   url: 'actions/get_site_issues.php',
   datatype: 'json',
   data: {
     site: site
   },
   success: function(data) {
     console.log(data);
   }
  });
});
