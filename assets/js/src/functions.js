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

  // Clear out any old charts
  $('#a_error, #a_warning, #a_review, #aa_error, #aa_warning, #aa_review, #aaa_error, #aaa_warning, #aaa_review').html('');

  // Make sure charts will display
  $('.charts, .pages').removeClass('hide');

  // Generate charts
  $.ajax({
   url: 'actions/get_site_issues.php',
   datatype: 'json',
   data: {
     site: site
   },
   success: function(data) {
     var dataObj = JSON.parse(data);
     $('.pages span').html(dataObj.pages);

     siChart.create(dataObj, 'a_error');
     siChart.create(dataObj, 'a_warning');
     siChart.create(dataObj, 'a_review');

     siChart.create(dataObj, 'aa_error');
     siChart.create(dataObj, 'aa_warning');
     siChart.create(dataObj, 'aa_review');

     siChart.create(dataObj, 'aaa_error');
     siChart.create(dataObj, 'aaa_warning');
     siChart.create(dataObj, 'aaa_review');
   }
  });
});
