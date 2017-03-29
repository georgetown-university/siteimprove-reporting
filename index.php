<?php require_once 'actions/api.php'; ?>
<?php require_once 'actions/functions.php'; ?>

<?php $sites = getSites(); ?>

<!DOCTYPE html>
<html>

<head>
  <title>Siteimprove Reporting</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>
  <header>
    <div class="container">
      <h1>Siteimprove Reporting</h1>
    </div>
  </header>

  <main class="container">
    <section class="highlight" aria-label="Fetch current Siteimprove data">
      <h2>Get the latest data</h2>
      <p>Make sure you have the latest issue data from Siteimprove.</p>
      <button id="getCurrentData" class="btn btn-primary">Get current data</button>
    </section>

    <section aria-label="Create issue reports by site">
      <h2>Get your report</h2>

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

    <section aria-label="Chart of A-level issues" class="chart hide">
      <h3>A-Level issues</h3>

      <div id="a_issues"></div>
    </section>

    <section aria-label="Chart of AA-level issues" class="chart hide">
      <h3>AA-Level issues</h3>

      <div id="aa_issues"></div>
    </section>

    <section aria-label="Chart of AAA-level issues" class="chart hide">
      <h3>AAA-Level issues</h3>

      <div id="aaa_issues"></div>
    </section>

  </main>

  <script src="assets/js/siteimprove-vendor.min.js"></script>
  <script src="assets/js/siteimprove.min.js"></script>
</body>

</html>
