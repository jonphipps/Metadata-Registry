#!/usr/bin/env bash

# Trigger deployment
# This will trigger an update of beta on a successful build
curl -s 'https://forge.laravel.com/servers/102862/sites/238869/deploy/http?token=VNCss4wCcwJGbqUrZWu2EWI4H6hDIIOxpCVDDPtZ';
echo 'Deployment triggered!'
