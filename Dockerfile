FROM openjdk:8-jdk-alpine
RUN mkdir -p /app
WORKDIR /app

COPY Segitiga.java /app

#compile file java
RUN javac Segitiga.java

#running java
CMD ["java","Segitiga"]
