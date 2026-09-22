# ==============================================================================
# Shoppee-Asia Development Shutdown Script
# ==============================================================================
# Usage:
#   .\stop.ps1
# ==============================================================================

Set-Location -Path $PSScriptRoot

Write-Host "==========================================" -ForegroundColor Cyan
Write-Host "   Shoppee-Asia Dev Environment Shutdown  " -ForegroundColor Cyan
Write-Host "==========================================" -ForegroundColor Cyan

# Step 1: Terminate running Laravel (php artisan serve) and Vite dev servers
Write-Host "`n[1/2] Stopping Laravel development server..." -ForegroundColor Yellow

$stoppedLaravel = $false

# 1a. Stop processes listening on Laravel port (default 8000)
$laravelPids = Get-NetTCPConnection -LocalPort 8000 -State Listen -ErrorAction SilentlyContinue | 
               Select-Object -ExpandProperty OwningProcess -Unique

foreach ($procId in $laravelPids) {
    Stop-Process -Id $procId -Force -ErrorAction SilentlyContinue
    $stoppedLaravel = $true
}

# 1b. Stop any PHP processes running artisan commands
$phpProcesses = Get-CimInstance Win32_Process -Filter "Name = 'php.exe'" -ErrorAction SilentlyContinue | 
                Where-Object { $_.CommandLine -like "*artisan*" }

foreach ($proc in $phpProcesses) {
    Stop-Process -Id $proc.ProcessId -Force -ErrorAction SilentlyContinue
    $stoppedLaravel = $true
}

# 1c. Stop Vite dev server on port 5173 if running
$vitePids = Get-NetTCPConnection -LocalPort 5173 -State Listen -ErrorAction SilentlyContinue | 
            Select-Object -ExpandProperty OwningProcess -Unique

foreach ($procId in $vitePids) {
    Stop-Process -Id $procId -Force -ErrorAction SilentlyContinue
}

if ($stoppedLaravel) {
    Write-Host "Laravel server stopped successfully." -ForegroundColor Green
} else {
    Write-Host "No active Laravel server found on port 8000." -ForegroundColor DarkGray
}

# Step 2: Stop Cloudflare Tunnel
Write-Host "`n[2/3] Stopping Cloudflare tunnel..." -ForegroundColor Yellow
$cloudflaredProcesses = Get-Process -Name "cloudflared" -ErrorAction SilentlyContinue

if ($cloudflaredProcesses) {
    $cloudflaredProcesses | Stop-Process -Force -ErrorAction SilentlyContinue
    Write-Host "Cloudflare tunnel stopped successfully." -ForegroundColor Green
} else {
    Write-Host "No active Cloudflare tunnel processes found." -ForegroundColor DarkGray
}

# Step 3: Stop Docker Compose services
Write-Host "`n[3/3] Stopping Docker Compose services (Postgres, Mailpit)..." -ForegroundColor Yellow
docker compose stop

if ($LASTEXITCODE -eq 0) {
    Write-Host "Docker containers stopped successfully." -ForegroundColor Green
} else {
    Write-Host "Failed to stop Docker containers. Please check Docker status." -ForegroundColor Red
}

Write-Host "`nAll development services stopped." -ForegroundColor Cyan
