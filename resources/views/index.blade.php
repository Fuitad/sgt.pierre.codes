@if ( file_exists( $indexPath = base_path('public/dist/index.html') ) )
  {{-- production --}}
  <?php require($indexPath) ?>
@else
  {{-- dev --}}
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Vumen - VueJS + Lumen</title>
      <style media="screen">
        html, body {
          height: 100%;
        }

        body {
          margin: 0;
          padding: 0;
          width: 100%;
          display: table;
        }

        iframe {
          margin: 0;
          padding: 0;
          height: 100%;
          width: 100%;
          border: 0;
        }
      </style>
    </head>
    <body>

      <iframe src="http://localhost:8081"></iframe>

    </body>
  </html>
@endif
