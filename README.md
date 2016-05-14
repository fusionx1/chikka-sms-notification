SMS Notification using Chikka API
This script shows how easy it is to integrate Chikka SMS notifications from your Pantheon project using Quicksilver. As a bonus, we also show you how to manage API keys outside of your site repository.

Instructions

Enable Incoming Webhooks for your Slack instance.
Copy the following variables:

1. chikka_client_id
2. chikka_client_secret
3. chikka_accesscode

into a file called secrets.json and store it in the private files directory of every environment where you want to trigger Slack notifications.

  $> echo '{"chikka_client_id": "f425c39deff1c7d688f96670df193f0144e26490163049092bcb22dfd9fb51a5", "chikka_client_secret": "c9d85dad4577df1d0e5d1ad09190c7fc3504652585e8271e162af353cd97ac35", "chikka_accesscode": "2929077771", "slack_channel": "#dcamp2016-pantheon", "slack_url": "https://hooks.slack.com/services/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"}' > secrets.json
  # Note, you'll need to copy the secrets into each environment where you want to trigger Chikka SMS notifications.
  $> `terminus site connection-info --env=dev --site=your-site --field=sftp_command`
      Connected to appserver.dev.d1ef01f8-364c-4b91-a8e4-f2a46f14237e.drush.in.
  sftp> cd files  
  sftp> mkdir private
  sftp> cd private
  sftp> put secrets.json
Add the example chikka-sms-notification.php script to the private directory in the root of your site's codebase, that is under version control. Note this is a different private directory than where the secrets.json is stored.

Add Quicksilver operations to your pantheon.yml
Test a deploy out!
Optionally, you may want to use the terminus workflows watch command to get immediate debugging feedback. You may also want to customize your notifications further. 

Example pantheon.yml

Here's an example of what your pantheon.yml would look like if this were the only Quicksilver operation you wanted to use. Pick and choose the exact workflows that you would like to see notifications for.

api_version: 1

workflows:
  deploy:
    after:
        - type: webphp
          description: send sms on deploy
          script: private/scripts/chikka_sms_notification.php
  sync_code:
    after:
        - type: webphp
          description: send sms on sync code
          script: private/scripts/chikka_sms_notification.php
  clear_cache:
    after:
        - type: webphp
          description: send sms when clearing cache
          script: private/scripts/chikka_sms_notification.php
