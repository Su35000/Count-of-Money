# Utilisez une image de base Node
FROM node:current-alpine3.18

# Définissez le répertoire de travail dans le conteneur
WORKDIR /app

# Copiez le fichier package.json et installez les dépendances
COPY package*.json ./
RUN npm install

# Copiez le reste des fichiers de votre application dans le conteneur
COPY . .

# Exposez le port que votre application utilise
EXPOSE 3000
