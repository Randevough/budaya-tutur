<#
.SYNOPSIS
    Automated Deployment Packager for Budaya Tutur Voices (Hostinger Shared Hosting)
.DESCRIPTION
    1. Runs Vite asset compilation (npm run build)
    2. Packages clean production files into build-preview.zip
    3. Excludes development bloat (node_modules, .git, .agents, tests, cache)
#>

Write-Host "=================================================" -ForegroundColor Cyan
Write-Host "  Budaya Tutur Voices - Production Build Packager" -ForegroundColor Cyan
Write-Host "=================================================" -ForegroundColor Cyan

# 1. Compile production assets with Vite
Write-Host "`n[1/3] Compiling frontend production bundle with Vite..." -ForegroundColor Yellow
npm run build
if ($LASTEXITCODE -ne 0) {
    Write-Error "Vite build failed! Aborting packaging."
    exit 1
}

# 2. Prepare destination path
$outputZip = Join-Path $PSScriptRoot "build-preview.zip"
if (Test-Path $outputZip) {
    Write-Host "`n[2/3] Removing existing $outputZip..." -ForegroundColor Yellow
    Remove-Item $outputZip -Force
} else {
    Write-Host "`n[2/3] Preparing clean output package..." -ForegroundColor Yellow
}

# 3. Create deployment archive using .NET ZipArchive
Write-Host "`n[3/3] Packaging files into build-preview.zip..." -ForegroundColor Yellow

$excludePatterns = @(
    "^\.git(\\|$)",
    "^\.agents(\\|$)",
    "^node_modules(\\|$)",
    "^tests(\\|$)",
    "^\.phpunit",
    "^build-preview\.zip$",
    "^deploy\.zip$",
    "^storage\\logs\\.*\.log$",
    "^storage\\framework\\cache\\data\\.*",
    "^storage\\framework\\sessions\\.*",
    "^storage\\framework\\views\\.*"
)

Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

$zipArchive = [System.IO.Compression.ZipFile]::Open($outputZip, [System.IO.Compression.ZipArchiveMode]::Create)

$allFiles = Get-ChildItem -Path $PSScriptRoot -Recurse -File

$count = 0
foreach ($file in $allFiles) {
    $relativePath = $file.FullName.Substring($PSScriptRoot.Length).TrimStart('\', '/')
    
    # Check exclusion patterns
    $skip = $false
    foreach ($pattern in $excludePatterns) {
        if ($relativePath -match $pattern) {
            $skip = $true
            break
        }
    }
    
    if (-not $skip) {
        $entryName = $relativePath.Replace('\', '/')
        [System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile($zipArchive, $file.FullName, $entryName, [System.IO.Compression.CompressionLevel]::Optimal) | Out-Null
        $count++
    }
}

$zipArchive.Dispose()

$zipItem = Get-Item $outputZip
$sizeMb = [math]::Round($zipItem.Length / 1MB, 2)

Write-Host "`n[SUCCESS] Package created successfully!" -ForegroundColor Green
Write-Host "File: $outputZip ($sizeMb MB, $count files included)" -ForegroundColor Green
Write-Host "`nDeployment Steps for Hostinger:" -ForegroundColor Cyan
Write-Host "1. Upload 'build-preview.zip' to Hostinger File Manager inside your subdomain folder (e.g. 'preview')."
Write-Host "2. Extract the ZIP archive."
Write-Host "3. Ensure subdomain document root is set to 'preview/public'."
Write-Host "4. Create .env with production credentials (refer to .env.example)."
Write-Host "5. SSH into Hostinger and run: 'php artisan migrate --force' && 'php artisan storage:link'."
