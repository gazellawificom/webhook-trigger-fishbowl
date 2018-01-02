# Fishbowl Marketing Webhook Trigger Example

A Trigger Webhook example for your Fishbowl Marketing account ( https://www.fishbowl.com ) 

## Getting Started

Setup a Webhook trigger within the triggers page of your account. Triggers make it easy for a custom action / script or form to be filled out to parsed to from each individual visit. 
This is good if Gazella does not provide your specific integration that you are looking for and you would like to transfer and send the data into any other format realtime. 

### Server Requirements
Php 5.6 or newer

### Availiable Parameters / Query Strings

**{name}** - Visitor Name<br />
**{time}** - Visitor Date / Time<br />
**{phone}** - Visitor Phone<br />
**{email}** - Visitor E-mail<br />
**{birthday}** - Visitor Birthday<br />


### Installing / Configuring

Upload "fishbowl-webhook-trigger-example.php" into your project folder. Example: http://yourcustomsite.com/project/fishbowl-webhook-trigger-example.php.
Once the file is uploaded you may then edit "fishbowl-fishbowl-webhook-trigger-example.php" by replacing the variables with the 'XXXXXXX' values with your specific details. Some of the details you may acquire from your Fishbowl marketing account or from their support. 

```
//======================================================================//
// CONFIGURATION
//======================================================================//  

/* This is the email address that this data will be posted to */
$sendto = 'XXXXXX';  // your@email.com

/* These are details needed from your Fishbowl Marketing account */
$user_user_subscribe_url = 'http://XXXXXXXX.fbmta.com/members/subscribe.aspx';  // http://youraccount.fbmta.com/members/subscribe.aspx
$user_guid = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; // A23465D0-FE25-2129-1930-348FA2E5A4B1
$user_user_list_id = 'XXXXXXXXXX'; // 17849029382
$user_storecode = 'XXX'; // 002 

```

### SETUP

Gazella Webhook Trigger:
> Setup here: https://sys.gazellawifi.com/triggers/


### Testing

Now that you have configured the "fishbowl-webhook-trigger-example.php" php example webhook url will look something like this assuming all parameters are used: 
http://yourcustomsite.com/project/fishbowl-webhook-trigger-example.php?name={name}&time={time}&phone={phone}&birthday={birthday}&email={email} 

Visit the link - and you should recieve an email with the data filled out.

The values surrounded by a LEFT CURLY BRACKET { and a RIGHT CURLY BRACKET } i.e. **{phone}** are dynamic - and these values will be populated by data provided by the Gazella System from your visitors. For instance if you were to have the user visit and input their phone number, this would be programmatically filled with the users phone number. When the script above is triggered, then you will be able to get the users phone number. 

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details