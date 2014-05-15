# 收集的一些小玩具

# 10 COMMON LINUX COMMANDS
history | awk '{CMD[$2]++;count++;} END{ for (a in CMD) print CMD[a] " " CMD[a]/count*100 "% " a;}' | grep -v "./" | column -c3 -s " " -t | sort -nr | nl | head -n10

#ssh without key
ssh-keygen -t rsa -C username
eval `ssh-agent -s`
ssh-add
ssh-copy-id -i ~/.ssh/id_rsa.pub hostname
