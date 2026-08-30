# ==============================================================================
# Shoppee-Asia Development Startup Script
# ==============================================================================
# Usage:
#   .\start.ps1                 -> Starts Docker containers & runs 'php artisan serve'
#   .\start.ps1 -Dev            -> Starts Docker containers & runs full dev suite (Vite + Queue + Logs + Serve)
#   .\start.ps1 -StopOnExit     -> Automatically stops Docker containers when server terminates
# ==============================================================================

[CmdletBinding()]
param (
    [switch]$Dev,
    [switch]$StopOnExit,
    [int]$Port = 8000
)

# Navigate to project root directory where the script resides
Set-Location -Path $PSScriptRoot

Write-Host "==========================================" -ForegroundColor Cyan
Write-Host "   Shoppee-Asia Dev Environment Starter   " -ForegroundColor Cyan
Write-Host "==========================================" -ForegroundColor Cyan

# Step 1: Check if Docker is installed & running
Write-Host "`n[1/2] Starting Docker Compose services (Postgres, Mailpit)..." -ForegroundColor Yellow
try {
    docker compose up -d
    if ($LASTEXITCODE -ne 0) {
        Write-Host "Docker compose failed with exit code $LASTEXITCODE. Please check if Docker Desktop is running." -ForegroundColor Red
        exit $LASTEXITCODE
    }
    Write-Host "Docker services are up and running!" -ForegroundColor Green
    Write-Host "  - PostgreSQL: 127.0.0.1:5430" -ForegroundColor DarkGray
    Write-Host "  - Mailpit UI: http://127.0.0.1:8025" -ForegroundColor DarkGray
}
catch {
    Write-Host "Error running docker compose: $_" -ForegroundColor Red
    exit 1
}

# Step 2: Start PHP Artisan Serve / Dev Suite
try {
    if ($Dev) {
        Write-Host "`n[2/2] Launching full dev environment (Serve + Vite + Queue + Logs)..." -ForegroundColor Yellow
        composer run dev
    }
    else {
        Write-Host "`n[2/2] Starting Laravel server at http://127.0.0.1:$Port (Press Ctrl+C to stop)..." -ForegroundColor Yellow
        php artisan serve --port=$Port
    }
}
finally {
    if ($StopOnExit) {
        Write-Host "`nStopping Docker services..." -ForegroundColor Yellow
        docker compose stop
        Write-Host "Docker services stopped." -ForegroundColor Green
    }
    else {
        Write-Host "`nNote: Docker containers (Postgres, Mailpit) are still running in background." -ForegroundColor Cyan
        Write-Host "To stop them, run: .\stop.ps1 (or docker compose stop)" -ForegroundColor DarkGray
    }
}
