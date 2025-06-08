## About App

This is a REST API application that handles witness reports.

API clients submit the name of a person of interest and a phone number for follow-up contact.

All witness reports are stored in a file.

Each report is validated before being stored:

We check if the reported person matches a case in the FBI Most Wanted database using the public FBI API.

We validate the user's phone number and their location.

