<?php

// Load config file.
include('config.php');

?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Version Dashboard</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css" type="text/css" media="all" />
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Kelly+Slab' rel='stylesheet' type='text/css'>
        <link href='main.css' rel='stylesheet' type='text/css'>
		<script src="main.js"></script>


	</head>
	<body>

		<h1>
			<svg height="1024" width="832" viewbox="0 0 1024 832" xmlns="http://www.w3.org/2000/svg">
			  <path d="M416 464.5c-61.562 0-111.5 49.938-111.5 111.5S354.438 687.5 416 687.5 527.5 637.562 527.5 576c0-8.5-1.125-16.75-3-24.688C606.125 456.375 732.5 308.34400000000005 800 224c23.125-28.875-2.312-56.188-32-32-85.188 69.375-232.312 194.688-326.906 275.594C433.031 465.719 424.625 464.5 416 464.5zM447.875 255.875c0-17.656-14.344-32-32-32s-32 14.344-32 32 14.344 32 32 32S447.875 273.53099999999995 447.875 255.875zM639.875 511.875c0 17.656 14.375 32 32 32s32-14.344 32-32-14.375-32-32-32S639.875 494.219 639.875 511.875zM287.875 255.875c-17.656 0-32 14.344-32 32s14.344 32 32 32 32-14.344 32-32S305.531 255.875 287.875 255.875zM223.875 383.875c0-17.656-14.344-32-32-32s-32 14.344-32 32 14.344 32 32 32S223.875 401.531 223.875 383.875zM127.875 511.875c0 17.656 14.344 32 32 32s32-14.344 32-32-14.344-32-32-32S127.875 494.219 127.875 511.875zM575.875 287.875c0-17.656-14.375-32-32-32s-32 14.344-32 32 14.375 32 32 32S575.875 305.53099999999995 575.875 287.875zM792.875 336.688l-68.75 89.938C731.625 453.812 736 482.375 736 512c0 176.75-143.312 320-320 320S96 688.75 96 512c0-176.688 143.312-320 320-320 65.875 0 127 19.969 177.875 54.094l79.25-60.625C602.375 129.59400000000005 513.25 96 416 96 186.25 96 0 282.25 0 512s186.25 416 416 416 416-186.25 416-416C832 449.281 817.75 390 792.875 336.688z" />
			</svg>
			<span>WordPress version status</span>
		</h1>

		<div class="servicelist">

			<?php

			// Update data.
			foreach ($config as $key => $url) {

				// Load json-response.
				$apiUrl = $url . '/wp-json/versiondashboardclient/v1/get_version_information/?key=' . $apiKey;
				$json = file_get_contents($apiUrl);

				if ($json) {

					$json = json_decode($json);

					if (isset($json->plugin_count)) {

						$status = "green";

						// Show red indicator if plugins need update.
						foreach ($json->plugins as $plugin) {
							if ($plugin->needs_update) {
								$status = "red";
							}
						}

						// Show red if core need update.
						if ($json->core_needs_update) $status = "red";

						?>
						<div class="servicelist__item">
							<div class="servicelist__item__row">
								<div class="servicelist__item__row__statusled"><div class="statusled statusled--<?php echo $status ?>"></div></div>
								<div class="servicelist__item__row__title"><?php $urlParts = parse_url($url); echo $urlParts['host'] ?> (<?php echo $json->core_current_version ?> / <?php echo $json->core_new_version ?>)</div>
							</div>
							<div class="servicelist__item__details">
								<?php foreach ($json->plugins as $plugin) : ?>
								<div class="servicelist__item__details__row">
									<div class="servicelist__item__details__row__statusled"><div class="statusled statusled--small statusled--<?php echo $plugin->needs_update ? "red" : "green" ?>"></div></div>
									<div class="servicelist__item__details__row__title"><?php echo $plugin->name ?></div>
									<div class="servicelist__item__details__row__current"><?php echo $plugin->current_version ?></div>
									<div class="servicelist__item__details__row__new"><?php echo $plugin->new_version ?></div>
								</div>
								<?php endforeach ?>
							</div>
						</div>
						<?php

					}

				} else {

					?>
					<div class="servicelist__item">
						<div class="servicelist__item__row">
							<div class="servicelist__item__row__statusled"><div class="statusled statusled--grey"></div></div>
							<div class="servicelist__item__row__title"><?php $urlParts = parse_url($url); echo $urlParts['host'] ?> <?php $json->message ?></div>
						</div>
						<div class="servicelist__item__details">
						</div>
					</div>
					<?php

				}

			}

			?>

		</div>

	</body>
</html>
