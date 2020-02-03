help: ## Prints this help.
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

build: ## Builds the docker container and installs dependencies
	docker build -t finder-kata .

test: ## Run unit tests
	@docker run --rm -v ${CURDIR}/src:/usr/app/src -v ${CURDIR}/tests:/usr/app/tests finder-kata
