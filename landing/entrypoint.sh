#!/bin/bash

# Environment variables needed:
# - DOMAIN
# - CERTBOT_EMAIL
# - USE_CERTBOT

# Set the path to the certificates directory
CERT_DIR="/etc/nginx/ssl"

# Check if should use certbot and no certs are made
if [ "$USE_CERTBOT" = "true" ] && ( [ ! -f "$CERT_DIR/fullchain.pem" ] || [ ! -f "$CERT_DIR/privkey.pem" ] ); then
  # Certificates not found, obtain them using Certbot
  certbot certonly \
    --non-interactive \
    --agree-tos \
    --email "$CERTBOT_EMAIL" \
    --domains "$DOMAIN" \
    --webroot \
    --webroot-path "/usr/share/nginx/html"

  # Move the obtained certificates to the specified directory
  cp /etc/letsencrypt/live/"$DOMAIN"/* "$CERT_DIR"

  # Provide appropriate permissions to the certificate files (optional)
  chmod 600 "$CERT_DIR"/*

# Shouldn't use certbot, but still need certs
elif [ ! -f "$CERT_DIR/fullchain.pem" ] || [ ! -f "$CERT_DIR/privkey.pem" ]; then
  # Certificates not found, generate self-signed certificates
  openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout "$CERT_DIR/privkey.pem" -out "$CERT_DIR/fullchain.pem" -subj "/CN=$DOMAIN"
fi

# Start Nginx
nginx -g "daemon off;"
