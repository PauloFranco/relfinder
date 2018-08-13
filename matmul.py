# -*- coding: utf-8 -*-
import sys
import json
import numpy as np
import math
from pprint import pprint



x = json.loads(sys.argv[1])

w = json.loads(sys.argv[2])

score = np.matmul(x,w)

print('%s' %x)
print('%s' %w)
print('%s' %score)