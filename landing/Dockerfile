FROM nginx

# Install Certbot and other dependencies
RUN apt-get update && \
    apt-get install -y certbot && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Remove the default Nginx configuration
RUN rm /etc/nginx/conf.d/default.conf

# Copy nginx config
COPY nginx.conf /etc/nginx/conf.d/

# Copy everything in the src folder to /usr/share/nginx/html
COPY src /usr/share/nginx/html

# Copy the entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

# Set execute permissions for the entrypoint script
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose ports
EXPOSE 80
EXPOSE 443

# Start entrypoint script
CMD ["/usr/local/bin/entrypoint.sh"]
