# You need to install the GCloud CLI app and authenticate using commands: 
#   gcloud auth login  
#   gcloud auth application-default login
# Also you need to create a GCS bucket manually
terraform {
 backend "gcs" {
   bucket  = "epam-project-terraform-backend"
   prefix  = "state.json"
 }
}
provider "google" {
 project = "epam-project-316707"
 region  = "europe-north1"
 zone    = "europe-north1-b"
}
resource "google_container_cluster" "epam_project_c1" {
 name     = "c1"
 location = "europe-north1-b"
 min_master_version = "1.18"
 remove_default_node_pool = true
 initial_node_count = 1
}
resource "google_container_node_pool" "linux_pool" {
 name               = "linux-pool"
 cluster            = google_container_cluster.epam_project_c1.name
 location           = google_container_cluster.epam_project_c1.location
 node_count = 3
    
 node_config {
   machine_type = "e2-standard-2"
   image_type   = "COS_CONTAINERD"
   oauth_scopes = [
     "https://www.googleapis.com/auth/cloud-platform"
   ]
 }
}
resource "google_container_registry" "registry" {
 location = "EU"
}