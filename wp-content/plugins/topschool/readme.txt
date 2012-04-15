wordpress plugin for submitting to topschool

-= Dependencies =-

* Gravity Forms - http://www.gravityforms.com/

-= Usage =-

When setting up the form, you will need to place the name that is in the topschool
pdf into the admin label field. For example if you create a form with a text
field of "First Name" then the admin label should be "firstname".

Another example is to create a field with a label of "ZIP Code" and the admin
label should be set to "pc"

-= How it works =-

When the Gravity form is submitted, this plugin will hook grab the info right
before the Gravity plugin does. It will run a few functions to make sure the
form is valid. If it is, then it sends the info off to Topschool