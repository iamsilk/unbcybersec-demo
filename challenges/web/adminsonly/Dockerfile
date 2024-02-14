# Use the official Node.js image as a base image
FROM node:14-alpine

# Set the working directory in the container
WORKDIR /app

# Copy package.json and package-lock.json to the container
COPY src/package*.json ./

# Install dependencies
RUN npm install

# Copy the application code to the container from src directory
COPY src/ .

# Expose port 3000
EXPOSE 3000

# Command to run the application
CMD ["npm", "start"]
