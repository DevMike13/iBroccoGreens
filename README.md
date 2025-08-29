# iBroccoGreens - IoT Solution for Microgreens Farming  

**iBroccoGreens** is a **web-based IoT platform** for real-time monitoring and automation of **broccoli microgreens farming**. Built with **Laravel (TALL Stack)**, **Firebase**, and **SIM800L GSM**, it tracks key growth parameters such as **soil moisture, soil pH, water pH, temperature (°C), and humidity (%)**.  

The system automates **irrigation, ventilation, and lighting**, while also sending **SMS alerts** when sensor thresholds are breached—ensuring growers can take immediate action even without internet access.  

Deployed on **Hostinger**.  
Live app: [iBroccoGreens](https://ibroccogreens.tech/)  

---

## Features  

### 🌱 Real-time Monitoring  
- **Soil Moisture (%)**: Tracks water content in growing trays.  
- **Soil pH**: Ensures balanced soil acidity/alkalinity.  
- **Water pH**: Monitors nutrient solution pH balance.  
- **Temperature (°C)**: Maintains optimal growth range.  
- **Humidity (%)**: Tracks air humidity in the growing environment.  
- Live graphs and history stored in **Firebase**.  

### ⚡ Automated Control  
- Automatic management of **irrigation**, **lighting**, and **ventilation**.  
- Thresholds configurable via the web dashboard.  

### 📩 SMS Threshold Alerts (SIM800L)  
- **SIM800L GSM module** sends SMS when sensor values exceed or fall below safe ranges.  
- Example alerts:  
  - **Soil Moisture < 40%** → “⚠ Low soil moisture detected.”  
  - **Water pH > 7.5** → “⚠ Water pH too high, adjust nutrients.”  
  - **Temperature > 30°C** → “⚠ High temperature in grow area.”  
- Works even without internet connectivity.  

### 📊 Cycle & Harvest Tracking  
- Create and track **growth cycles**.  
- Record **harvest yield (grams/kilograms)** for performance analysis.  

### 🎛 Manual Control  
- Web interface to manually activate **pumps, fans, or lights**.  

---

## Hardware Setup  

1. **ESP8266** – central IoT controller.  
2. **SIM800L GSM Module** – sends SMS alerts for threshold breaches.  
3. **Sensors**:  
   - **Soil Moisture Sensor** – irrigation monitoring.  
   - **Soil pH Sensor** – soil condition monitoring.  
   - **Water pH Sensor** – nutrient solution monitoring.  
   - **DHT22** – temperature & humidity tracking.  
4. **Actuators**:  
   - **Water pump** – irrigation control.  
   - **Ventilation fan** – airflow management.  
   - **Grow lights** – automated light cycles.  

---

## Installation  

### Prerequisites  
- **PHP** (>=7.4)  
- **Composer**  
- **Node.js & NPM**  
- **Laravel (latest)**  
- **Firebase Project**  
- **ESP8266 + SIM800L + Sensors**  

### Steps  

1. Clone the repository:  
   ```bash
   git clone https://github.com/DevMike13/iBroccoGreens.git
   cd iBroccoGreens
