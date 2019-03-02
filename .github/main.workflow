workflow "Continuous Deployment" {
  on = "push"
  resolves = ["Build static pages", "Deploy to GitHub Pages"]
}

action "Only run on source branch" {
  uses = "actions/bin/filter@master"
  args = "branch source"
}

action "Install asset dependencies" {
  uses = "actions/npm@master"
  args = "install"
  needs = ["Only run on source branch"]
}

action "Build production assets" {
  uses = "actions/npm@master"
  args = "run production"
  needs = ["Install asset dependencies"]
}

action "Install Composer dependencies" {
  uses = "pxgamer/composer-action@master"
  args = "install --prefer-dist"
  needs = ["Only run on source branch"]
}

action "Build static pages" {
  uses = "pxgamer/composer-action@master"
  args = "build-production"
  needs = ["Install Composer dependencies"]
}

action "Deploy to GitHub Pages" {
  uses = "maxheld83/ghpages@v0.2.1"
  needs = ["Build production assets", "Build static pages"]
  env = {
    BUILD_DIR = "build_production/"
  }
  secrets = ["GH_PAT"]
}
