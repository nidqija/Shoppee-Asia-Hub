# Shopee-Asia Developer Cheatsheet
Quick reference for Laravel Artisan, Docker Container (`8b039ec77a2e`), PostgreSQL, and multi-region sharded API commands.

---

## 1. Docker & PostgreSQL Commands (Container ID: 8b039ec77a2e)

### Container Management
```powershell
# Start all database containers in the background
docker compose up -d

# Stop all database containers
docker compose down

# Check container status and port mappings
docker ps

# View database container logs
docker logs 74c0a1d3cbbffbb952f647960cb71ab1b59d9dd05f22da3bb3b8740f0bf41387 --tail 50 -f
```

### Direct PostgreSQL Access (psql)
PowerShell

```
# Connect to Central Database
docker exec -it 74c0a1d3cbbffbb952f647960cb71ab1b59d9dd05f22da3bb3b8740f0bf41387 psql -U postgres -d shoppee-central

# Connect to Malaysia Shard (Port 5430)
docker exec -it 74c0a1d3cbbffbb952f647960cb71ab1b59d9dd05f22da3bb3b8740f0bf41387 psql -U postgres -d shoppee-shard-my

# Connect to Singapore Shard (Port 5431)
docker exec -it 74c0a1d3cbbffbb952f647960cb71ab1b59d9dd05f22da3bb3b8740f0bf41387 psql -U postgres -d shoppee-shard-sg
```

### Useful psql CLI Commands (Inside psql)
**Command****Description**`\l`List all databases`\c <database_name>`Connect / switch to another database`\dt`List all tables in current database`\d <table_name>`Describe table schema & column types`\q`Quit psql session
### One-Line PostgreSQL Queries from PowerShell
PowerShell

```
# Query Central users table
docker exec -it 74c0a1d3cbbffbb952f647960cb71ab1b59d9dd05f22da3bb3b8740f0bf41387 psql -U postgres -d shoppee-central -c "SELECT id, email, home_region, status FROM users;"

# Query Malaysia products table
docker exec -it 74c0a1d3cbbffbb952f647960cb71ab1b59d9dd05f22da3bb3b8740f0bf41387 psql -U postgres -d shoppee-shard-my -c "SELECT id, title, price, category_slug FROM products;"

# Query Singapore products table
docker exec -it 74c0a1d3cbbffbb952f647960cb71ab1b59d9dd05f22da3bb3b8740f0bf41387 psql -U postgres -d shoppee-shard-sg -c "SELECT id, title, price, category_slug FROM products;"
```

## 2. Laravel Artisan Commands

### Local Server & API Routes
PowerShell

```
# Start local Laravel server
php artisan serve

# View registered API routes
php artisan route:list --path=api

# Interactive Laravel REPL
php artisan tinker
```

### Cache & Optimization
PowerShell

```
# Clear all application cache
php artisan optimize:clear

# Clear specific caches
php artisan config:clear
php artisan route:clear
php artisan cache:clear
```

### Multi-Database Migrations
PowerShell

```
# Migrate Central DB only
php artisan migrate --database=central --path=database/migrations/central

# Fresh Migrate Central DB (Drops all tables & re-runs)
php artisan migrate:fresh --database=central --path=database/migrations/central

# Migrate Malaysia Shard only
php artisan migrate --database=shard_my --path=database/migrations/shard

# Fresh Migrate Malaysia Shard
php artisan migrate:fresh --database=shard_my --path=database/migrations/shard

# Migrate Singapore Shard only
php artisan migrate --database=shard_sg --path=database/migrations/shard

# Fresh Migrate Singapore Shard
php artisan migrate:fresh --database=shard_sg --path=database/migrations/shard
```

### Create New Migrations in the Right Directory
PowerShell

```
# 1. Create a migration in the CENTRAL directory (e.g. create_coupons_table)
php artisan make:migration create_coupons_table --path=database/migrations/central

# 2. Create a migration in the SHARD directory (e.g. create_orders_table)
php artisan make:migration create_orders_table --path=database/migrations/shard

# 3. Create a migration specifically to alter an existing table (e.g. add_avatar_to_users)
php artisan make:migration add_avatar_to_users_table --table=users --path=database/migrations/central
```

### Database Seeding
PowerShell

```
# Run the complete multi-database master seeder
php artisan db:seed

# Run a specific seeder class
php artisan db:seed --class=CentralDatabaseSeeder
php artisan db:seed --class=ShardDatabaseSeeder
```

## 3. Sharded API Testing (cURL for PowerShell)

### Authentication (Central DB)
PowerShell

```
# Register a New User
curl.exe -s -X POST http://127.0.0.1:8000/api/auth/signup -H "Accept: application/json" -H "Content-Type: application/json" -d "{\"email\":\"raziq@example.com\",\"password\":\"Password123!\",\"password_confirmation\":\"Password123!\",\"home_region\":\"MY\",\"phone_number\":\"+60123456789\",\"role\":\"seller\"}"

# User Sign In / Login
curl.exe -s -X POST http://127.0.0.1:8000/api/auth/signin -H "Accept: application/json" -H "Content-Type: application/json" -d "{\"email\":\"raziq@example.com\",\"password\":\"Password123!\"}"
```

### Regional Product Queries (Dynamic Header Routing)
PowerShell

```
# Fetch Malaysia Shard (MY)
curl.exe -s -H "Accept: application/json" -H "X-Region: my" http://127.0.0.1:8000/api/products

# Fetch Singapore Shard (SG)
curl.exe -s -H "Accept: application/json" -H "X-Region: sg" http://127.0.0.1:8000/api/products

# Scatter-Gather (Global Catalog across all shards)
curl.exe -s -H "Accept: application/json" http://127.0.0.1:8000/api/products/global
```

## 4. Git Commands
PowerShell

```
# Check tracked status
git status

# Stage all files
git add .

# Commit changes
git commit -m "feat: sharded multi-region product and auth setup"
```

```
<ElicitationsGroup message="Where should we focus next?">
  <Elicitation label="Connect the Blade authentication UI to the API using JavaScript fetch()" query="Write the client-side JavaScript for the Blade template to submit login and signup forms to /api/auth and handle tokens."/>
  <Elicitation label="Create a custom Artisan command to migrate all shards in one go" query="Create a custom Artisan command `php artisan app:migrate-all` to run migrations across central and all regional shard databases."/>
</ElicitationsGroup>
```
