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
    chart.colors = this.generateColors(chart);

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
  generateColors: function(chart) {
    let count = chart.data.counts.length;
    let attrs = { count: count };

    if (chart.colorseed) {
      attrs.seed = chart.colorseed;
    };

    if (chart.hue) {
      attrs.hue = chart.hue;
    };

    return randomColor(attrs);
  }
};
