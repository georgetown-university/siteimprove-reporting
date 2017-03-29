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

    <section aria-label="Select box of all Siteimprove sites">
      <h2>Get your report</h2>

      <select class="custom-select" id="selectSite">
        <option value="" disabled selected>Select a site...</option>
        <?php foreach($sites as $site): ?>
          <option value="<?php print $site['site_name']; ?>">
            <?php print $site['site_name']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </section>
  </main>

  <script src="assets/js/siteimprove-vendor.min.js"></script>
  <script src="assets/js/siteimprove.min.js"></script>
</body>

</html>
