<?php require_once 'actions/api.php'; ?>
<?php require_once 'actions/functions.php'; ?>

<?php $sites = getSites(); ?>

<!DOCTYPE html>
<html>

<head>
  <title>Georgetown Sites Accessibility Summary</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
  <header>
    <div class="container">
      <h1>Georgetown Sites Accessibility Summary</h1>
    </div>
  </header>

  <main>
    <section class="highlight container" aria-label="Fetch current Siteimprove data">
      <h2>Get the latest data</h2>
      <p>Make sure you have the latest issue data from Siteimprove.</p>

      <button id="getCurrentData" class="btn btn-danger">Get current data</button>

      <p id="fetchingData">
        <span class="spinner"><span class="bounce1"></span><span class="bounce2"></span><span class="bounce3"></span></span>
        Fetching current issue data.
      </p>

      <p id="doneFetchingData">Issue data is up-to-date!</p>
    </section>

    <section class="container" aria-label="Create issue reports by site">
      <h2>Get your report</h2>
      <p>
        Select a site to see historical data on the number of A, AA, and AAA
        errors, warnings, and review items for that site.  The total number of
        issues is the sum of the number of pages where each unique issue exists.
      </p>

      <select class="custom-select" id="selectSite">
        <option value="" disabled selected>Select a site...</option>
        <?php foreach($sites as $site): ?>
          <option value="<?php print $site['site_name']; ?>">
            <?php print $site['site_name']; ?>
          </option>
        <?php endforeach; ?>
      </select>

      <p class="pages hide">This site has <span>#</span> pages.</p>
    </section>

    <section aria-label="Charts of all A-level issues" class="charts hide">
      <header aria-labelledby="a-header">
        <h3 class="container" id="a-header">A conformance level</h3>
      </header>

      <div class="container">
        <h4>Errors</h4>
        <div id="a_error" class="chart"></div>

        <h4>Warnings</h4>
        <div id="a_warning" class="chart"></div>

        <h4>Review Items</h4>
        <div id="a_review" class="chart"></div>
      </div>
    </section>

    <section aria-label="Charts of all AA-level issues" class="charts hide">
      <header aria-labelledby="aa-header">
        <h3 class="container" id="aa-header">AA conformance level</h3>
      </header>

      <div class="container">
        <h4>Errors</h4>
        <div id="aa_error" class="chart"></div>

        <h4>Warnings</h4>
        <div id="aa_warning" class="chart"></div>

        <h4>Review Items</h4>
        <div id="aa_review" class="chart"></div>
      </div>
    </section>

    <section aria-label="Charts of all AAA-level issues" class="charts hide">
      <header aria-labelledby="aaa-header">
        <h3 class="container" id="aaa-header">AAA conformance level</h3>
      </header>

      <div class="container">
        <h4>Errors</h4>
        <div id="aaa_error" class="chart"></div>

        <h4>Warnings</h4>
        <div id="aaa_warning" class="chart"></div>

        <h4>Review Items</h4>
        <div id="aaa_review" class="chart"></div>
      </div>
    </section>
  </main>

  <script src="assets/js/siteimprove-vendor.min.js"></script>
  <script src="assets/js/siteimprove.min.js"></script>
</body>

</html>
