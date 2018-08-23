#!/usr/bin/env bash

# Trigger deployment
# This will trigger an update of beta on a successful build
curl -s ${TRIGGER_BETA};
# This will update the beta code at the rda subdomain
curl -s ${TRIGGER_RDA};
echo 'Deployment triggered!'
