<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Language" content="en" />
    <title>Harness Feature Flags Sample</title>
  </head>
  <body>
    <pre id="log"></pre>

    <script type="module">
      import { initialize, Event } from 'https://unpkg.com/@harnessio/ff-javascript-client-sdk@1.4.4/dist/sdk.client.js'

      const log = msg => {
        document.querySelector('#log').innerHTML += `${msg}\n`
      }

      const cf = initialize(
        'c8451467-ea97-44cb-8f34-f8275bde03fa',
        {
          identifier: 'ecointet',
          attributes: {
            lastUpdated: Date(),
            host: location.href,
            browser: navigator.userAgent
          }
        }
      )

      cf.on(Event.READY, flags => {
        log(JSON.stringify(flags, null, 2))
      })

      cf.on(Event.CHANGED, flagInfo => {
        if (flagInfo.deleted) {
          log('Flag is deleted')
          log(JSON.stringify(flagInfo, null, 2))
        } else {
          log('Flag is changed')
          log(JSON.stringify(flagInfo, null, 2))
        }
      })
    </script>
</html>