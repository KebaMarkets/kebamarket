Prerequisites
Make sure the following tools are installed on your machine:
Docker ≥ 24
Docker Compose (plugin, docker compose)

To verify installation run:
docker --version
docker compose version

1. Clone project from GitHub: git clone https://github.com/KebaMarkets/kebamarket.git
2. move to directory: cd kebamarket
3. create env file: cp .env.example .env.local
4. build and run docker containers: docker compose up -d --build
5. check the docker containers: docker ps
6. Check the HealthCheck endpoint: curl http://localhost:8001/health
   Expected response:
   {
   "app": "ok",
   "db": "ok",
   "redis": "ok"
   }
7. Stopping the Project: docker compose down
8. To fully clean up, including removing the volumes (e.g., Postgres data): docker compose down -v


