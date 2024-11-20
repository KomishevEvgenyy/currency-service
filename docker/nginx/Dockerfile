FROM nginx:stable-alpine

# ADD Custom Config
ADD ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
ADD ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Make Directory - Workspace
RUN mkdir -p /var/www/html

# ADD and set Group
RUN addgroup -g 1000 admin && adduser -G admin -g admin -s /bin/sh -D admin

# Set Group to Workspace
RUN chown admin:admin /var/www/html