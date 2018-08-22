#!/usr/bin/env bash
curl --user ${CIRCLE_TOKEN}: \
    --request POST \
    --form revision=7d6f908849ccab3660b6438f6c052eee345caf15 \
    --form config=@config.yml \
    --form notify=false \
        https://circleci.com/api/v1.1/project/github/jonphipps/Metadata-Registry/tree/stage
