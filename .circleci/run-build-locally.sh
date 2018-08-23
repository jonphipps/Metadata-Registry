#!/usr/bin/env bash
curl --user ${CIRCLE_TOKEN}: \
    --request POST \
    --form revision=c81843da03d0bf593693e70865c57d935e8e4a7d \
    --form config=@config.yml \
    --form notify=false \
        https://circleci.com/api/v1.1/project/github/jonphipps/Metadata-Registry/tree/stage
