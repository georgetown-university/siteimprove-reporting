var siChart = {

  /* ---
   * Function to create all charts for the page.
   *   - Charts are defined by the (not real) HTML <chart> tag.
   *   - Makes async AJAX calls for each chart.
   */
  create: function(data, type) {
    let chart = {};
    chart.el = $('#' + type)[0];
    chart.data = this.processData(data, type);
    chart.colors = this.generateColors(type);

    pfBarChart.display(chart, 'horizontal');
  },

  /* ---
   * Function that saves out labels and chart data.
   */
  processData: function(data, type) {
    let labels = [], counts = [];

    for (let key in data.reports) {
      if (data.reports[key][type] !== undefined) {
        labels.push(key);
        counts.push(data.reports[key][type]);
      }
    }

    return { 'labels': labels, 'counts': counts };
  },

  /* ---
   * Function that generates an array of colors for the chart
   */
  generateColors: function(type) {
    if (type.includes('error')) {
      return '#AD0A0E'
    }

    if (type.includes('warning')) {
      return '#D3550A'
    }

    if (type.includes('review')) {
      return '#4E44C2'
    }
  }
};
